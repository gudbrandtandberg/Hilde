<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 *  @version $Id: acl.php 251 2011-04-13 09:20:16Z nikosdion $
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');

// Load framework base classes
jimport('joomla.application.component.model');

/**
 * The tiny ACL system model
 */
class AdmintoolsModelAcl extends JModel
{
	private $viewACLmap = array(
		'acl'				=> 'security',
		'adminpw'			=> 'security',
		'adminuser'			=> 'maintenance',
		'badwords'			=> 'security',
		'cleantmp'			=> 'utils',
		'cpanel'			=> 'utils',
		'dbchcol'			=> 'maintenance',
		'dbprefix'			=> 'maintenance',
		'dbtools'			=> 'maintenance',
		'eom'				=> 'utils',
		'fixperms'			=> 'utils',
		'fixpermsconfig'	=> 'utils',
		'geoblock'			=> 'security',
		'htmaker'			=> 'security',
		'ipbl'				=> 'security',
		'ipwl'				=> 'security',
		'jupdate'			=> 'utils',
		'log'				=> 'security',
		'masterpw'			=> 'security',
		'redirs'			=> 'utils',
		'seoandlink'		=> 'utils',
		'waf'				=> 'security',
		'wafconfig'			=> 'security'
	);
	
	public function authorizeViewAccess($view = null, $user_id = null)
	{
		if(empty($view)) {
			$view = JRequest::getCmd('view','cpanel');
		}

		if(!array_key_exists($view, $this->viewACLmap)) {
			$axo = 'security';
		} else {
			$axo = $this->viewACLmap[$view];
		}
		
		if(version_compare(JVERSION,'1.6.0','ge')) {
			// Joomla! 1.6 ACL
			$user = JFactory::getUser();
			if($user->authorise('core.admin')) {
				return true;
			}
			if (!$user->authorise('admintools.'.$axo, 'com_admintools')) {
				$this->setRedirect('index.php?option=com_admintools');
				return JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
				$this->redirect();
			}
		} else {
			// Joomla! 1.5 custom ACL
			return $this->authorizeUser($axo, $user_id);
		}
	}
	
	/**
	 * Public function to authorize a user's access to a specific Akeeba AXO.
	 * @param string $axo One of Akeeba Backup's AXOs (download, configuration, backup). 
	 * @param int $user_id The user ID to control. Use null for current user.
	 */
	public function authorizeUser($axo, $user_id = null)
	{
		// Load the ACLs and cache them for future use
		static $acls = null;
		
		if(is_null($acls)) {
			$db = $this->getDBO();
			$db->setQuery('SELECT * FROM '.$db->nameQuote('#__admintools_acl'));
			$acls = $db->loadObjectList('user_id');
			if(empty($acls)) $acls = array();
		}
		
		// Get the user ID and the user object
		if(!is_null($user_id)) {
			$user_id = (int)$user_id;
		}
		
		if(empty($user_id)) {
			$user =& JFactory::getUser();
			$user_id = $user->id;
		} else {
			$user =& JFactory::getUser($user_id);
		}
		
		// Get the default (group) permissions
		$defaultPerms = $this->getDefaultPermissions($user->gid);
		
		// Get the user permissions, if any
		if(array_key_exists($user_id, $acls)) {
			$acl = $acls[$user_id];	
		} else {
			$acl = null;
		}
		
		if(is_object($acl)) {
			$userPerms = json_decode($acl->permissions, true);
		} else {
			$userPerms = array();
		}
		
		// Find out the correct set of permissions (user permissions override default ones)
		$perms = array_merge($defaultPerms, $userPerms);
		
		// Return the control status of these permissions
		if(array_key_exists($axo, $perms)) {
			return $perms[$axo] == 1;
		} else {
			return true;
		}
	}
	
	
	/**
	 * Gets the default permissions for a Joomla! 1.5 user group
	 * @param int $gid The Group ID to test for
	 */
	public function getDefaultPermissions($gid)
	{
		$permissions = array(
			'utils'			=> 0,
			'security'		=> 0,
			'maintenance'	=> 0
		);
		
		switch($gid)
		{
			case 25:
				// Super administrator
				$permissions = array(
					'utils'			=> 1,
					'security'		=> 1,
					'maintenance'	=> 1
				);
				break;
				
			case 24:
				$permissions = array(
					'utils'			=> 1,
					'security'		=> 0,
					'maintenance'	=> 1
				);
				break;
				
			case 23:
				$permissions = array(
					'utils'			=> 1,
					'security'		=> 0,
					'maintenance'	=> 0
				);
				break;
		}
		
		return $permissions;
	}
	
	public function &getUserList()
	{
		$db = $this->getDBO();
		$sql = 'SELECT `id`, `username`, `usertype` FROM `#__users` WHERE `gid` > 23 AND `block` = 0';
		$db->setQuery($sql);
		$list = $db->loadAssocList();
		for($i=0; $i < count($list); $i++)
		{
			$list[$i]['utils'] = $this->authorizeUser('utils', $list[$i]['id']);
			$list[$i]['security'] = $this->authorizeUser('security', $list[$i]['id']);
			$list[$i]['maintenance'] = $this->authorizeUser('maintenance', $list[$i]['id']);
		}
		
		return $list;
	}
	
	public function getMinGroup()
	{
		$component =& JComponentHelper::getComponent( 'com_admintools' );
		$params = new JParameter($component->params);
		$min_acl = $params->get('minimum_acl_group','super administrator');
		return $min_acl;		
	}
	
	public function setMinGroup($group)
	{
		$group = strtolower($group);
		if(!in_array($group,array('super administrator','administrator','manager'))) {
			$group = 'super administrator';
		}
		
		$component =& JComponentHelper::getComponent( 'com_admintools' );
		$params = new JParameter($component->params);
		$params->set('minimum_acl_group', $group);
		$data = $params->toString();
		
		$db =& JFactory::getDBO();
		// Joomla! 1.5
		$sql = 'UPDATE `#__components` SET `params` = '.$db->Quote($data).' WHERE '.
			"`option` = 'com_admintools' AND `parent` = 0 AND `menuid` = 0";

		$db->setQuery($sql);
		$db->query();		
	}
}