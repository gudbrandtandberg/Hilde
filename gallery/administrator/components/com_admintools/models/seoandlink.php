<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 *  @version $Id: seoandlink.php 178 2011-02-16 08:43:23Z nikosdion $
 */

// Protect from unauthorized access
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class AdmintoolsModelSeoandlink extends JModel
{
	var $defaultConfig = array(
		'linkmigration'	=> 0,
		'migratelist'	=> '',
		'httpsizer'		=> 0
	);

	function getConfig()
	{
		$component =& JComponentHelper::getComponent( 'com_admintools' );
		$params = new JParameter($component->params);
		$config = $params->toArray();
		$config = array_merge($this->defaultConfig, $config);
		return $config;
	}

	function saveConfig($newParams)
	{
		$component =& JComponentHelper::getComponent( 'com_admintools' );
		$params = new JParameter($component->params);

		foreach($newParams as $key => $value)
		{
			$params->set($key,$value);
		}

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
	}
}