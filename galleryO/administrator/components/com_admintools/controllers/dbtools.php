<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 *  @version $Id: dbtools.php 124 2010-12-31 11:22:51Z nikosdion $
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.controller');

require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'controllers'.DS.'default.php';

class AdmintoolsControllerDbtools extends AdmintoolsControllerDefault
{
	public function purgesessions()
	{
		$model = $this->getThisModel();
		$model->purgeSessions();
		$this->setRedirect('index.php?option=com_admintools',JText::_('ATOOLS_LBL_PURGECOMPLETE'));
	}
}
