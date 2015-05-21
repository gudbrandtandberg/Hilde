<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 *  @version $Id: view.html.php 254 2011-04-15 22:06:10Z nikosdion $
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');

// Load framework base classes
jimport('joomla.application.component.view');

class AdmintoolsViewJupdate extends JView
{
	function display()
	{
		// Set the toolbar title
		JToolBarHelper::title(JText::_('ADMINTOOLS_TITLE_JUPDATE'),'admintools');

		$task = JRequest::getCmd('task','default');
		$force = ($task == 'force');

		switch($task)
		{
			case 'default':
			default:
				// Get the update information
				$updates = $this->getModel('jupdate');
				$updateinfo = $updates->getUpdateInfo($force);
				$this->assign('updateinfo',			$updateinfo );

				JToolBarHelper::back((ADMINTOOLS_JVERSION == '15') ? 'Back' : 'JTOOLBAR_BACK', 'index.php?option=com_admintools');

				$this->setLayout('default');

				break;

			case 'preinstall':
				$updates = $this->getModel('jupdate');
				$file = JRequest::getString('file','');
				$ftpparams			= $updates->getFTPParams();
				$extractionmodes	= $updates->getExtractionModes();

				$this->assign('hasakeeba',		$updates->hasAkeebaBackup());
				$this->assign('file',			$file);
				$this->assign('ftpparams',		$ftpparams);
				$this->assign('extractionmodes',$extractionmodes);

				$this->setLayout('preinstall');

				break;

			case 'install':
				$session =& JFactory::getSession();
				$password = $session->get('update_password', '', 'admintools');
				$file = JRequest::getString('file','');

				if(empty($password))
				{
					$password = JRequest::getVar('password','','default','none',2);
				}
				$this->assign('password', $password );
				$this->assign('file',			$file);

				$this->setLayout('install');

				break;
		}


		// Load CSS
		$document = JFactory::getDocument();
		$document->addStyleSheet('../media/com_admintools/css/backend.css');
		$document->addScript('../media/com_admintools/js/json2.js');
		$document->addScript('../media/com_admintools/js/encryption.js');
		$document->addScript('../media/com_admintools/js/backend.js');
		
		// Repeat after me: "Joomla! 1.6.2 and later is a piece of utter crap because it requires me
		// to MANUALLY add this line to make its STANDARD toolbar buttons work". Yes, the PLT is a
		// bunch of morons.
		JHTML::_('behavior.mootools');

		parent::display();
	}
}