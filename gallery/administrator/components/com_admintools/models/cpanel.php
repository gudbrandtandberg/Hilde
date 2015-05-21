<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 *  @version $Id: cpanel.php 169 2011-02-11 22:38:10Z nikosdion $
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.model');

/**
 * The Control Panel model
 *
 */
class AdmintoolsModelCpanel extends JModel
{
	/**
	 * Constructor; dummy for now
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getPluginID()
	{
		if(ADMINTOOLS_JVERSION == '15') {
			$db = $this->getDBO();
			$sql = 'SELECT id'
				. ' FROM #__plugins'
				. ' WHERE published >= 1'
				. ' AND (folder = "system")'
				. ' AND (element = "admintools")'
				. ' ORDER BY ordering'
				. ' LIMIT 0,1';
			$db->setQuery( $sql );
			$id = $db->loadResult();			
		} else {
			$db = $this->getDBO();
			$sql = 'SELECT extension_id'
				. ' FROM #__extensions'
				. ' WHERE enabled >= 1'
				. ' AND (folder = "system")'
				. ' AND (element = "admintools")'
				. ' AND (type = "plugin")'
				. ' ORDER BY ordering'
				. ' LIMIT 0,1';
			$db->setQuery( $sql );
			$id = $db->loadResult();
		}
		return $id;
	}

}