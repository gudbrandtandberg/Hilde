<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 *  @version $Id: jupdate.php 146 2011-01-24 11:50:22Z nikosdion $
 */

// Protect from unauthorized access
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class AdmintoolsModelJupdate extends JModel
{
	/** @var object Latest Joomla! version information */
	private $jversion = null;

	/**
	 * Gets the latest known Joomla! version
	 * @return array
	 */
	public function getLatestJoomlaVersion($force = false)
	{
		// Check if it's stored in the static variable
		if(!empty($this->jversion) && !$force) return $this->jversion;

		// Check the cache age
		$component =& JComponentHelper::getComponent( 'com_admintools' );
		$params = new JParameter($component->params);
		$lastdate = $params->get('lastjupdatecheck', '2005-09-01');

		jimport('joomla.utilities.date');
		$date = new JDate($lastdate);
		$now = new JDate();

		if( (abs($now->toUnix() - $date->toUnix()) < 21600) && !$force )
		{
			// Checked before 6 hours or more recently. Try to fetch from cache.
			$jversion_data = $params->get('latestjversion', '{}');
			$this->jversion = @json_decode($jversion_data, true);
			if(empty($this->jversion)) $this->jversion = null;
		}

		if(!empty($this->jversion) && !$force) return $this->jversion;

		// Cache is broken or out of date. Get the packages list out of
		// Joomla!'s FRS in JoomlaCode.org
		require_once JPATH_ADMINISTRATOR.DS.'components'.DS.'com_admintools'.DS.'classes'.DS.'joomlacode.php';
		$jc = new JoomlacodeScanner();

		$jc->useCache = true;
		$jc->setProject('joomla');

		$packages = $jc->getPackages();

		// If we could not retrieve the packages, bail out
		if(empty($packages)) return $this->jversion;

		// Get the Joomla! 1.5 or 1.6 packages.
		$frsPackage = null;
		$packages = array_keys($packages);
		$test = 'JOOMLA'.substr(ADMINTOOLS_JVERSION,0,1).'.'.substr(ADMINTOOLS_JVERSION,1,1);
		$frsPackage = 'joomla1.5.0'; // required for version checking reasons
		foreach($packages as $package)
		{
			if( substr( strtoupper($package), 0, 9 ) == $test )
			{
				$old_version_number = substr($frsPackage,6);
				$this_version_number = substr($package,6);
				if( version_compare($this_version_number, $old_version_number) == 1 )
				{
					$frsPackage = $package;
				}
			}
		}

		// Check for inexistent FRS package
		if(empty($frsPackage)) return $this->jversion;

		// Now, get the releases information
		$releases = $jc->getReleases($frsPackage);

		// If we could not retrieve the releases, bail out
		if(empty($releases)) return $this->jversion;

		// Seed the version information
		$version = trim(str_replace('JOOMLA', '', strtoupper($frsPackage)));
		$jversion = array(
			'version'	=> $version,
			'updates'	=> array(),
			'full'		=> null
		);

		// Get the release keys for full and update packages
		$releases = array_keys($releases);
		$updateRelease = null; $normalRelease = null;
		foreach($releases as $release)
		{
			if(strstr(strtoupper($release), 'UPDATE')) {
				$updateRelease = $release;
			} else {
				$normalRelease = $release;
			}
		}

		// Grab the updates
		if(!empty($updateRelease))
		{
			$files = $jc->getFiles($frsPackage, $updateRelease);
			if(!empty($files)) foreach($files as $filename => $url)
			{
				// Only process .ZIP files
				if(strtoupper(substr($filename,-4)) != '.ZIP' ) continue;
				// Get basename, e.g. Joomla_1.5.12_to_1.5.20-Stable-Patch_Package
				$basename = basename(strtolower($filename), '.zip');
				// Remove joomla_
				$basename = str_replace('joomla_','',$basename);
				// Grab the version
				list($oldVersion, $junk) = explode('_',$basename,2);
				// Add to array
				$jversion['updates'][$oldVersion] = $url;
			}
		}

		// Grab the full package's URL
		if(!empty($normalRelease))
		{
			$files = $jc->getFiles($frsPackage, $normalRelease);
			if(!empty($files)) foreach($files as $filename => $url)
			{
				// Only process the .ZIP file
				if(strtoupper(substr($filename,-4)) != '.ZIP' ) continue;
				// Add to array
				$jversion['full'] = $url;
			}
		}

		// Convert to object and json
		$this->jversion = $jversion;
		$jversion_data = json_encode($this->jversion);

		// Save to cache
		$date = new JDate();
		$params->set('latestjversion', $jversion_data );
		$params->set('lastjupdatecheck', $date->toUnix(false));

		$db =& JFactory::getDBO();
		$data = $params->toString();

		if( ADMINTOOLS_JVERSION != '15' )
		{
			// Joomla! 1.6
			$sql = 'UPDATE `#__extensions` SET `params` = '.$db->Quote($data).' WHERE '.
				"`element` = 'com_admintools' AND `type` = 'component'";
		}
		else
		{
			// Joomla! 1.5
			$sql = 'UPDATE `#__components` SET `params` = '.$db->Quote($data).' WHERE '.
				"`option` = 'com_admintools' AND `parent` = 0 AND `menuid` = 0";
		}

		$db->setQuery($sql);
		$db->query();

		// Return the new data
		return $this->jversion;
	}

	/**
	 * Returns information about whether we need to update Joomla!
	 * @staticvar string $updateInfo
	 * @return string
	 */
	public function getUpdateInfo($force = false)
	{
		static $updateInfo = null;

		if(!empty($updateInfo)) return $updateInfo;

		$updateInfo = (object)array(
			'status'	=> null,
			'version'	=> '',
			'current'	=> '',
			'update'	=> '',
			'full'		=> ''
		);

		$jversion = $this->getLatestJoomlaVersion($force);
		if(empty($jversion)) return $updateInfo;

		$updateInfo->version = $jversion['version'];
		$updateInfo->full = $jversion['full'];

		$jv = new JVersion();
		$updateInfo->current = $jv->getShortVersion();

		$updateInfo->status = version_compare( $updateInfo->version, $updateInfo->current ) == 1 ? true : false;
		if(array_key_exists($updateInfo->current, $jversion['updates']))
		{
			$updateInfo->update = $jversion['updates'][$updateInfo->current];
		}
		else
		{
			$updateInfo->update = null;
		}

		return $updateInfo;
	}

	/**
	 * Handles downloading an update to the temp directory
	 */
	public function download($item = 'upgrade')
	{
		// Get version info
		$versionInfo = $this->getUpdateInfo();

		// Find the package file's URL and base name
		if($item == 'upgrade') {
			$packageURL = $versionInfo->update;
		} else {
			$packageURL = $versionInfo->full;
		}
		$basename = basename($packageURL);

		// Find the path to the temp directory and the local package
		$jreg =& JFactory::getConfig();
		$tempdir = $jreg->getValue('config.tmp_path');
		$target = $tempdir.DS.$basename;

		// Do we have a cached file?
		jimport('joomla.filesystem.file');
		$exists = JFile::exists($target);

		if(!$exists)
		{
			// Not there, let's fetch it
			return $this->downloadPackage($packageURL, $target);
		}
		else
		{
			// Is it a 0-byte file? If so, re-download please.
			$filesize = @filesize($target);
			if(empty($filesize)) return $this->downloadPackage($packageURL, $target);

			// Yeap, it's there, skip downloading
			return $basename;
		}

	}

	/**
	 * Attempt to download a big package file intelligently, using cURL or fopen()
	 * URL wrappers. In the cURL mode, if the target is directly writtable it uses
	 * very few memory. Otherwise, make sure you have at least a dozen Mb free memory.
	 * @param $url string The URL to download from
	 * @param $target string The absolute path where to store the file
	 */
	private function downloadPackage($url, $target)
	{
		JLoader::import('helpers.download', JPATH_COMPONENT_ADMINISTRATOR);
		$result = AdmintoolsHelperDownload::download($url, $target);
		if(!$result) return false;
		return basename($target);
	}

	/**
	 * Generates a pseudo-random password
	 * @param int $length The length of the password in characters
	 * @return string The requested password string
	 */
	private function makeRandomPassword( $length = 32 )
	{
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		$maxchars = strlen($chars);
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;

		while ($i <= $length) {
			$num = rand() % $maxchars;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}

		return $pass;
	}

	/**
	 * Checks if the site has Akeeba Backup 3.1 or later installed
	 * @return bool
	 */
	public function hasAkeebaBackup()
	{
		$component =& JComponentHelper::getComponent( 'com_akeeba', true );
		if($component->enabled)
		{
			// Figure out the version
			include_once JPATH_ADMINISTRATOR.DS.'components'.DS.'com_akeeba'.DS.'version.php';
			jimport('joomla.utilities.date');
			$date = new JDate(AKEEBA_DATE);
			// Check that the release date was after September 3rd, 2010
			return $date->toUnix() > 1283490000;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Get the site's FTP parameters from Joomla!'s configuration
	 * @return array
	 */
	public function getFTPParams()
	{
		$config =& JFactory::getConfig();
		return array(
			'procengine'	=> $config->getValue('config.ftp_enable', 0) ? 'ftp' : 'direct',
			'ftp_host'		=> $config->getValue('config.ftp_host', 'localhost'),
			'ftp_port'		=> $config->getValue('config.ftp_port', '21'),
			'ftp_user'		=> $config->getValue('config.ftp_user', ''),
			'ftp_pass'		=> $config->getValue('config.ftp_pass', ''),
			'ftp_root'		=> $config->getValue('config.ftp_root', ''),
			'tempdir'		=> $config->getValue('config.tmp_path', '')
		);
	}

	/**
	 * Gets an options list for extraction modes
	 * @return array
	 */
	public function getExtractionModes()
	{
		$options = array();
		$options[] = JHTML::_('select.option', 'direct', JText::_('ATOOLS_LBL_EXTRACTIONMETHOD_DIRECT'));
		$options[] = JHTML::_('select.option', 'ftp', JText::_('ATOOLS_LBL_EXTRACTIONMETHOD_FTP'));
		return $options;
	}

	public function createRestorationINI()
	{
		// Get a password
		$password = $this->makeRandomPassword(32);
		JRequest::setVar('password', $password);
		$session =& JFactory::getSession();
		$session->set('update_password', $password ,'admintools');

		// Do we have to use FTP?
		$procengine = JRequest::getCmd('procengine','direct');

		// Get the absolute path to site's root
		$siteroot = JPATH_SITE;

		// Get the package name
		$file = JRequest::getString('file','');
		if(empty($file)) return false;
		$jreg =& JFactory::getConfig();
		$tempdir = $jreg->getValue('config.tmp_path');
		$file  = $tempdir.DS.$file;

		$data = "<?php\ndefined('_AKEEBA_RESTORATION') or die('Restricted access');\n";
		$data .= '$restoration_setup = array('."\n";
		$data .= <<<ENDDATA
	'kickstart.security.password' => '$password',
	'kickstart.tuning.max_exec_time' => '5',
	'kickstart.tuning.run_time_bias' => '75',
	'kickstart.tuning.min_exec_time' => '0',
	'kickstart.procengine' => '$procengine',
	'kickstart.setup.sourcefile' => '$file',
	'kickstart.setup.destdir' => '$siteroot',
	'kickstart.setup.restoreperms' => '0',
	'kickstart.setup.filetype' => 'zip',
	'kickstart.setup.dryrun' => '0'
ENDDATA;

		if($procengine == 'ftp')
		{
			$ftp_host	= JRequest::getVar('ftp_host','');
			$ftp_port	= JRequest::getVar('ftp_port', '21');
			$ftp_user	= JRequest::getVar('ftp_user', '');
			$ftp_pass	= JRequest::getVar('ftp_pass', '', 'default', 'none', 2); // Password should be allowed as raw mode, otherwise !@<sdf34>43H% would be trimmed to !@43H% which is plain wrong :@
			$ftp_root	= JRequest::getVar('ftp_root', '');

			// Is the tempdir really writable?
			$writable = @is_writeable($tempdir);
			if($writable) {
				// Let's be REALLY sure
				$fp = @fopen($tempdir.'/test.txt','w');
				if($fp === false) {
					$writable = false;
				} else {
					fclose($fp);
					unlink($tempdir.'/test.txt');
				}
			}

			// If the tempdir is not writable, create a new writable subdirectory
			if(!$writable) {
				jimport('joomla.client.ftp');
				jimport('joomla.client.helper');
				jimport('joomla.filesystem.folder');

				$FTPOptions = JClientHelper::getCredentials('ftp');
				$ftp = & JFTP::getInstance($FTPOptions['host'], $FTPOptions['port'], null, $FTPOptions['user'], $FTPOptions['pass']);
				$dest = JPath::clean(str_replace(JPATH_ROOT, $FTPOptions['root'], $tempdir.'/admintools'), '/');
				if(!@mkdir($tempdir.'/admintools')) $ftp->mkdir($dest);
				if(!@chmod($tempdir.'/admintools', 511)) $ftp->chmod($dest, 511);

				$tempdir .= '/admintools';
			}

			// Just in case the temp-directory was off-root, try using the default tmp directory
			$writable = @is_writeable($tempdir);
			if(!$writable) {
				$tempdir = JPATH_ROOT.'/tmp';

				// Does the JPATH_ROOT/tmp directory exist?
				if(!is_dir($tempdir)) {
					jimport('joomla.filesystem.folder');
					jimport('joomla.filesystem.file');
					JFolder::create($tempdir, 511);
					JFile::write($tempdir.'/.htaccess',"order deny, allow\ndeny from all\nallow from none\n");
				}

				// If it exists and it is unwritable, try creating a writable admintools subdirectory
				if(!is_writable($tempdir)) {
					jimport('joomla.client.ftp');
					jimport('joomla.client.helper');
					jimport('joomla.filesystem.folder');

					$FTPOptions = JClientHelper::getCredentials('ftp');
					$ftp = & JFTP::getInstance($FTPOptions['host'], $FTPOptions['port'], null, $FTPOptions['user'], $FTPOptions['pass']);
					$dest = JPath::clean(str_replace(JPATH_ROOT, $FTPOptions['root'], $tempdir.'/admintools'), '/');
					if(!@mkdir($tempdir.'/admintools')) $ftp->mkdir($dest);
					if(!@chmod($tempdir.'/admintools', 511)) $ftp->chmod($dest, 511);

					$tempdir .= '/admintools';
				}
			}

			// If we still have no writable directory, we'll try /tmp and the system's temp-directory
			$writable = @is_writeable($tempdir);
			if(!$writable) {
				if(@is_dir('/tmp') && @is_writable('/tmp')) {
					$tempdir = '/tmp';
				} else {
					// Try to find the system temp path
					$tmpfile = @tempnam("dummy","");
					$systemp = @dirname($tmpfile);
					@unlink($tmpfile);
					if(!empty($systemp)) {
						if(@is_dir($systemp) && @is_writable($systemp)) {
							$tempdir = $systemp;
						}
					}
				}
			}

			$data.=<<<ENDDATA
	,
	'kickstart.ftp.ssl' => '0',
	'kickstart.ftp.passive' => '1',
	'kickstart.ftp.host' => '$ftp_host',
	'kickstart.ftp.port' => '$ftp_port',
	'kickstart.ftp.user' => '$ftp_user',
	'kickstart.ftp.pass' => '$ftp_pass',
	'kickstart.ftp.dir' => '$ftp_root',
	'kickstart.ftp.tempdir' => '$tempdir'
ENDDATA;
		}

		$data .= ');';

		// Remove the old file, if it's there...
		jimport('joomla.filesystem.file');
		$configpath = JPATH_COMPONENT_ADMINISTRATOR.DS.'restoration.php';
		if( JFile::exists($configpath) )
		{
			JFile::delete($configpath);
		}

		// Write new file. First try with JFile.
		$result = JFile::write( $configpath, $data );
		// In case JFile used FTP but direct access could help
		if(!$result) {
			if(function_exists('file_put_contents')) {
				$result = @file_put_contents($configpath, $data);
				if($result !== false) $result = true;
			} else {
				$fp = @fopen($configpath, 'wt');
				if($fp !== false) {
					$result = @fwrite($fp, $data);
					if($result !== false) $result = true;
					@fclose($fp);
				}
			}
		}
		return $result;
	}

	/**
	 * Post-update clean up
	 * @param string $file The update filename
	 */
	public function finalize($file)
	{
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');

		// Where is our temp directory?
		$jreg =& JFactory::getConfig();
		$tempdir = $jreg->getValue('config.tmp_path');

		// Remove the update file
		if(!empty($file)) {
			if(!@unlink($tempdir.'/'.$file)) JFile::delete($tempdir.'/'.$file);
		}

		// Delete the temp-dir we may have created
		if(is_dir($tempdir.'/admintools')) {
			JFolder::delete($tempdir.'/admintools');
		}
	}
}