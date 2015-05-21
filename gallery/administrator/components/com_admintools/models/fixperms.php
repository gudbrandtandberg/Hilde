<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 *  @version $Id: fixperms.php 124 2010-12-31 11:22:51Z nikosdion $
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.model');

class AdmintoolsModelFixperms extends JModel
{
	/** @var float The time the process started */
	private $startTime = null;

	/** @var array The folders to process */
	private $folderStack = array();

	/** @var array The files to process */
	private $filesStack = array();

	/** @var int Total numbers of folders in this site */
	public $totalFolders = 0;

	/** @var int Numbers of folders already processed */
	public $doneFolders = 0;

	/** @var int Default directory permissions */
	private $dirperms = 0755;

	/** @var int Default file permissions */
	private $fileperms = 0644;

	/** @var array Custom permissions */
	private $customperms = array();

	public function  __construct($config = array()) {
		parent::__construct($config);

		$component =& JComponentHelper::getComponent( 'com_admintools' );
		$params = new JParameter($component->params);

		$dirperms = '0'.ltrim(trim($params->get('dirperms', '0755')),'0');
		$fileperms = '0'.ltrim(trim($params->get('fileperms', '0644')),'0');

		$dirperms = octdec($dirperms);
		if( ($dirperms < 0600) || ($dirperms > 0777) ) $dirperms = 0755;
		$this->dirperms = $dirperms;

		$fileperms = octdec($fileperms);
		if( ($fileperms < 0600) || ($fileperms > 0777) ) $fileperms = 0755;
		$this->fileperms = $fileperms;

		$db = $this->getDBO();
		$sql = 'SELECT `path`,`perms` FROM `#__admintools_customperms` ORDER BY `path` ASC';
		$db->setQuery($sql);
		$this->customperms = $db->loadAssocList('path');
	}

	/**
	 * Returns the current timestampt in decimal seconds
	 */
	private function microtime_float()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}

	/**
	 * Starts or resets the internal timer
	 */
	private function resetTimer()
	{
		$this->startTime = $this->microtime_float();
	}

	/**
	 * Makes sure that no more than 3 seconds since the start of the timer have
	 * elapsed
	 * @return bool
	 */
	private function haveEnoughTime()
	{
		$now = $this->microtime_float();
		$elapsed = abs($now - $this->startTime);
		return $elapsed < 2;
	}

	/**
	 * Saves the file/folder stack in the session
	 */
	private function saveStack()
	{
		$stack = array(
			'folders'	=> $this->folderStack,
			'files'		=> $this->filesStack,
			'total'		=> $this->totalFolders,
			'done'		=> $this->doneFolders
		);
		$stack = json_encode($stack);
		if(function_exists('base64_encode') && function_exists('base64_decode'))
		{
			if(function_exists('gzdeflate') && function_exists('gzinflate'))
			{
				$stack = gzdeflate($stack, 9);
			}
			$stack = base64_encode ($stack);
		}
		$session =& JFactory::getSession();
		$session->set('fixperms_stack', $stack ,'admintools');
	}

	/**
	 * Resets the file/folder stack saved in the session
	 */
	private function resetStack()
	{
		$session =& JFactory::getSession();
		$session->set('fixperms_stack', '' ,'admintools');
		$this->folderStack = array();
		$this->filesStack = array();
		$this->totalFolders = 0;
		$this->doneFolders = 0;
	}

	/**
	 * Loads the file/folder stack from the session
	 */
	private function loadStack()
	{
		$session =& JFactory::getSession();
		$stack = $session->get('fixperms_stack', '' ,'admintools');

		if(empty($stack))
		{
			$this->folderStack = array();
			$this->filesStack = array();
			$this->totalFolders = 0;
			$this->doneFolders = 0;
			return;
		}

		if(function_exists('base64_encode') && function_exists('base64_decode'))
		{
			$stack = base64_decode($stack);
			if(function_exists('gzdeflate') && function_exists('gzinflate'))
			{
				$stack = gzinflate($stack);
			}
		}
		$stack = json_decode($stack, true);

		$this->folderStack = $stack['folders'];
		$this->filesStack = $stack['files'];
		$this->totalFolders = $stack['total'];
		$this->doneFolders = $stack['done'];
	}

	/**
	 * Scans $root for directories and updates $folderStack
	 * @param string $root The full path of the directory to scan
	 */
	public function getDirectories($root = null)
	{
		if(empty($root)) $root = JPATH_ROOT;
		jimport('joomla.filesystem.folder');

		$folders = JFolder::folders($root,'.',false,true);
		$this->totalFolders += count($folders);
		if(!empty($folders)) $this->folderStack = array_merge($this->folderStack, $folders);
	}

	/**
	 * Scans $root for files and updates $filesStack
	 * @param string $root The full path of the directory to scan
	 */
	public function getFiles($root = null)
	{
		if(empty($root)) $root = JPATH_ROOT;

		if(empty($root))
		{
			$root = '..';
			$root = realpath($root);
		}

		$root = rtrim($root,'/').'/';

		jimport('joomla.filesystem.folder');

		$folders = JFolder::files($root,'.',false,true);
		$this->filesStack = array_merge($this->filesStack, $folders);

		$this->totalFolders += count($folders);
	}

	public function startScanning()
	{
		$this->resetStack();
		$this->resetTimer();
		$this->getDirectories();
		$this->getFiles();
		$this->saveStack();

		if(!$this->haveEnoughTime())
		{
			return true;
		}
		else
		{
			return $this->run(false);
		}
	}

	public function chmod($path, $mode)
	{
		if(is_string($mode))
		{
			$mode = octdec($mode);
			if( ($mode <= 0) || ($mode > 0777) ) $mode = 0755;
		}

		// Initialize variables
		jimport('joomla.client.helper');
		$ftpOptions = JClientHelper::getCredentials('ftp');

		// Check to make sure the path valid and clean
		$path = JPath::clean($path);

		if ($ftpOptions['enabled'] == 1) {
			// Connect the FTP client
			jimport('joomla.client.ftp');
			$ftp = &JFTP::getInstance(
				$ftpOptions['host'], $ftpOptions['port'], null,
				$ftpOptions['user'], $ftpOptions['pass']
			);
		}

		if(@chmod($path, $mode))
		{
			$ret = true;
		} elseif ($ftpOptions['enabled'] == 1) {
			// Translate path and delete
			jimport('joomla.client.ftp');
			$path = JPath::clean(str_replace(JPATH_ROOT, $ftpOptions['root'], $path), '/');
			// FTP connector throws an error
			$ret = $ftp->chmod($path, $mode);
		} else {
			return false;
		}
	}

	public function run($resetTimer = true)
	{
		if($resetTimer) $this->resetTimer();

		$this->loadStack();

		$result = true;
		while($result && $this->haveEnoughTime())
		{
			$result = $this->RealRun();
		}

		$this->saveStack();

		return $result;
	}

	private function RealRun()
	{
		while(empty($this->filesStack) && !empty($this->folderStack))
		{
			// Get a directory
			$dir = null;

			while(empty($dir) && !empty($this->folderStack))
			{
				// Get the next directory
				$dir = array_shift($this->folderStack);
				// Skip over non-directories and symlinks
				if(!@is_dir($dir) || @is_link($dir))
				{
					$dir = null;
					continue;
				}
				// Skip over . and ..
				$checkDir = str_replace('\\','/',$dir);
				if( in_array(basename($checkDir), array('.','..')) || (substr($checkDir,-2) == '/.') || (substr($checkDir,-3) == '/..') )
				{
					$dir = null;
					continue;
				}
				// Check for custom permissions
				$reldir = $this->getRelativePath($dir);
				if(array_key_exists($reldir, $this->customperms)) {
					$perms = $this->customperms[$reldir]['perms'];
				} else {
					$perms = $this->dirperms;
				}

				// Apply new permissions
				$this->chmod($dir, $perms);
				$this->doneFolders++;
				$this->getDirectories($dir);
				$this->getFiles($dir);

				if(!$this->haveEnoughTime())
				{
					// Gotta continue in the next step
					return true;
				}
			}
		}

		if(empty($this->filesStack) && empty($this->folderStack))
		{
			// Just finished
			$this->resetStack();
			return false;
		}

		if(!empty($this->filesStack) && $this->haveEnoughTime())
		{
			while(!empty($this->filesStack))
			{
				$file = array_shift($this->filesStack);

				// Skip over symlinks and non-files
				if(@is_link($file) || !@is_file($file))
				{
					continue;
				}

				$reldir = $this->getRelativePath($file);
				if(array_key_exists($reldir, $this->customperms)) {
					$perms = $this->customperms[$reldir]['perms'];
				} else {
					$perms = $this->fileperms;
				}

				$this->chmod($file, $perms);
				$this->doneFolders++;
			}
		}

		if(empty($this->filesStack) && empty($this->folderStack))
		{
			// Just finished
			$this->resetStack();
			return false;
		}

		return true;
	}

	public function getRelativePath($somepath)
	{
		$path = JPath::clean($somepath,'/');

		// Clean up the root
		$root = JPath::clean(JPATH_ROOT, '/');

		// Find the relative path and get the custom permissions
		$relpath = ltrim(substr($path, strlen($root) ), '/');

		return $relpath;
	}

}