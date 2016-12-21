<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 *  @version $Id: default.php 124 2010-12-31 11:22:51Z nikosdion $
 */

// Protect from unauthorized access
defined('_JEXEC') or die();

$option = JRequest::getCmd('option','com_admintools');
?>

<?php if($this->more): ?>
<h1><?php echo JText::_('ATOOLS_LBL_CLEANTMPINPROGRESS'); ?></h1>
<?php else: ?>
<h1><?php echo JText::_('ATOOLS_LBL_CLEANTMPDONE'); ?></h1>
<?php endif; ?>

<div id="progressbar-outer">
	<div id="progressbar-inner"></div>
</div>

<form action="index.php" name="adminForm" id="adminForm">
	<input type="hidden" name="option" value="com_admintools" />
	<input type="hidden" name="view" value="cleantmp" />
	<input type="hidden" name="task" value="run" />
	<input type="hidden" name="tmpl" value="component" />
</form>

<?php if(!$this->more): ?>
<div class="disclaimer">
	<h3><?php echo JText::_('ATOOLS_LBL_AUTOCLOSE_IN_3S'); ?></h3>
</div>
<script type="text/javascript">
	window.setTimeout('closeme();', 3000);
	function closeme()
	{
		parent.SqueezeBox.close();
	}
</script>
<?php endif; ?>