<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 *  @version $Id: cpanel.php 157 2011-01-27 18:43:42Z nikosdion $
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.controller');

require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'controllers'.DS.'default.php';

class AdmintoolsControllerCpanel extends AdmintoolsControllerDefault
{
	public function display()
	{
		$model = $this->getModel('Jupdate',		'AdmintoolsModel');
		$model3 = $this->getModel('Adminpw',	'AdminToolsModel');
		$model4 = $this->getModel('Masterpw',	'AdminToolsModel');

		$view = $this->getThisView();
		$view->setModel($model,		true);
		$view->setModel($model3,	false);
		$view->setModel($model4,	false);

		parent::display();
	}

	public function login()
	{
		$model = $this->getModel('Masterpw');
		$password = JRequest::getVar('userpw','');
		$model->setUserPassword($password);

		$url = 'index.php?option=com_admintools';
		$this->setRedirect($url);
	}
}
