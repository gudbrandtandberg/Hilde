<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 *  @version $Id: masterpw.php 174 2011-02-15 09:00:25Z nikosdion $
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.model');

class AdmintoolsModelMasterpw extends JModel
{
	var $views = array('adminpw','badwords','dbtools','eom','fixperms',
		'fixpermsconfig','htmaker','ipbl','ipwl','jupdate','log','redirs',
		'update','waf','wafconfig','cleantmp','dbchcol','seoandlink',
		'dbprefix','acl');
	
	/**
	 * Checks if the user should be granted access to the current view,
	 * based on his Master Password setting.
	 * @param string view Optional. The string to check. Leave null to use the current view.
	 * @return bool
	 */
	public function accessAllowed($view = null)
	{
		$component =& JComponentHelper::getComponent( 'com_admintools' );
		$params = new JParameter($component->params);
		$masterHash = $params->get('masterpassword','');
		if(!empty($masterHash))
		{
			$masterHash = md5($masterHash);
			// Compare the master pw with the one the user entered
			$session = JFactory::getSession();
			$userHash = $session->get('userpwhash', '', 'admintools');
			if($userHash != $masterHash)
			{
				// The login is invalid. If the view is locked I'll have to kick the user out.
				$lockedviews_raw = $params->get('lockedviews','');
				if(!empty($lockedviews_raw))
				{
					if(empty($view)) {
						$view = JRequest::getCmd('view','cpanel');
					}
					$lockedViews = explode(",", $lockedviews_raw);
					if(in_array($view,$lockedViews))
					{
						return false;
					}
				}
			}
		}
		return true;		
	}
	
	/**
	 * Compares the user-supplied password against the master password
	 * @return bool True if the passwords match
	 */
	public function hasValidPassword()
	{
		$component =& JComponentHelper::getComponent( 'com_admintools' );
		$params = new JParameter($component->params);
		$masterHash = $params->get('masterpassword','');
		
		if(empty($masterHash)) return true;
		
		$masterHash = md5($masterHash);		
		$session = JFactory::getSession();
		$userHash = $session->get('userpwhash', '', 'admintools');

		return ($masterHash == $userHash);
	}
	
	/**
	 * Stores the hash of the user's password in the session
	 * @param $passwd string The password supplied by the user
	 */
	public function setUserPassword($passwd)
	{
		$session = JFactory::getSession();
		$userHash = md5($passwd);
		$session->set('userpwhash', $userHash, 'admintools');
	}
	
	/**
	 * Saves the Master Password and the proteected views list
	 * @param string $masterPassword The new master password 
	 * @param array $protectedViews A list of the views to protect
	 */
	public function saveSettings($masterPassword, array $protectedViews)
	{
		$component =& JComponentHelper::getComponent( 'com_admintools' );
		$params = new JParameter($component->params);
		
		// Add the new master password
		$params->set('masterpassword', $masterPassword);
		
		// Add the protected views
		if(!in_array('masterpw', $protectedViews)) $protectedViews[] = 'masterpw';
		$params->set('lockedviews', implode(',', $protectedViews));
		
		// Save in the database
		$data = $params->toString();
		$db =& JFactory::getDBO();
		
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
	}
	
	/**
	 * Get a list of the views which can be locked down and their lockdown status
	 * @return array
	 */
	public function getItemList()
	{
		$lockedViews = array();
		
		$component =& JComponentHelper::getComponent( 'com_admintools' );
		$params = new JParameter($component->params);
		$lockedviews_raw = $params->get('lockedviews','');
		if(!empty($lockedviews_raw)) $lockedViews = explode(",", $lockedviews_raw);

		$views = array();
		foreach($this->views as $view)
		{
			$views[$view] = in_array($view, $lockedViews);
		}
		return $views;
	}
	
	public function getPagination()
	{
		return null;
	}

	/**
	 * Returns the stored master password
	 * @return string
	 */
	public function getMasterPassword()
	{
		$component =& JComponentHelper::getComponent( 'com_admintools' );
		$params = new JParameter($component->params);
		return $params->get('masterpassword','');
	}
	
}