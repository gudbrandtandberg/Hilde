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

class AdmintoolsViewSeoandlink extends JView
{
	function display()
	{
		// Set the toolbar title
		JToolBarHelper::title(JText::_('ADMINTOOLS_TITLE_SEOANDLINK'),'admintools');

		JToolBarHelper::save();
		JToolBarHelper::back((ADMINTOOLS_JVERSION == '15') ? 'Back' : 'JTOOLBAR_BACK','index.php?option=com_admintools');

		$model = $this->getModel();
		$config = $model->getConfig();

		$this->assign('config',			$config);

		// Load CSS
		$document = JFactory::getDocument();
		$document->addStyleSheet('../media/com_admintools/css/backend.css');
		
		// Repeat after me: "Joomla! 1.6.2 and later is a piece of utter crap because it requires me
		// to MANUALLY add this line to make its STANDARD toolbar buttons work". Yes, the PLT is a
		// bunch of morons.
		JHTML::_('behavior.mootools');

		// Load the selection helper
		require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'select.php';

		parent::display();
	}
}