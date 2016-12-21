<?php
/**
 * @package   Radiance Template - RocketTheme
 * @version   1.2 April 25, 2012
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Rockettheme Radiance Template uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
	
<div class="user">

	<?php if ( $this->params->get( 'show_page_title' ) ) : ?>
	<h1 class="rt-pagetitle">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
	<?php endif; ?>

	<p><?php echo JText::_('REMIND_USERNAME_DESCRIPTION'); ?></p>

	<form action="<?php echo JRoute::_( 'index.php?option=com_user&task=remindusername' ); ?>" method="post" class="josForm form-validate">
	<fieldset>
		<legend><?php echo JText::_( 'REMIND_USERNAME_EMAIL_TIP_TITLE' ) ?></legend><br />

		<div>
			<label for="email" class="hasTip" title="<?php echo JText::_('REMIND_USERNAME_EMAIL_TIP_TITLE'); ?>::<?php echo JText::_('REMIND_USERNAME_EMAIL_TIP_TEXT'); ?>"><?php echo JText::_('Email Address'); ?>:</label>
		<input id="email" name="email" type="text" class="required validate-email" />
		</div><br />
		<div class="readon">
			<button type="submit" class="button"><?php echo JText::_('Submit'); ?></button>
		</div>
	</fieldset>
	<?php echo JHTML::_( 'form.token' ); ?>
	</form>

</div>