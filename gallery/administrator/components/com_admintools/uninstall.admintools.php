<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 *  @version $Id: uninstall.admintools.php 221 2011-03-17 10:34:45Z nikosdion $
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// no direct access
defined('_JEXEC') or die('');

jimport('joomla.installer.installer');
$db = & JFactory::getDBO();
$status = new JObject();
$status->modules = array();
$status->plugins = array();
$src = $this->parent->getPath('source');

if(version_compare(JVERSION,'1.6.0','ge')) {
	$db->setQuery('SELECT `extension_id` FROM #__extensions WHERE `element` = "mod_atjupgrade" AND `type` = "module"');
} else {
	$db->setQuery('SELECT `id` FROM #__modules WHERE `module` = "mod_atjupgrade"');
}
$id = $db->loadResult();
if($id)
{
	$installer = new JInstaller;
	$result = $installer->uninstall('module',$id,1);
	$status->modules[] = array('name'=>'mod_atjupgrade','client'=>'administrator', 'result'=>$result);
}

if(version_compare(JVERSION,'1.6.0','ge')) {
	$db->setQuery('SELECT `extension_id` FROM #__extensions WHERE `type` = "plugin" AND `element` = "admintools" AND `folder` = "system"');
} else {
	$db->setQuery('SELECT `id` FROM #__plugins WHERE `element` = "admintools" AND `folder` = "system"');
}
$id = $db->loadResult();
if($id)
{
	$installer = new JInstaller;
	$result = $installer->uninstall('plugin',$id,1);
	$status->plugins[] = array('name'=>'plg_admintools','group'=>'system', 'result'=>$result);
}
?>

<?php $rows = 0;?>
<img src="../media/com_admintools/images/admintools-48.png" width="48" height="48" alt="Admin Tools" align="right" />
<h2><?php echo JText::_('Admin Tools Uninstallation Status'); ?></h2>
<table class="adminlist">
	<thead>
		<tr>
			<th class="title" colspan="2"><?php echo JText::_('Extension'); ?></th>
			<th width="30%"><?php echo JText::_('Status'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3"></td>
		</tr>
	</tfoot>
	<tbody>
		<tr class="row0">
			<td class="key" colspan="2"><?php echo 'Admin Tools '.JText::_('Component'); ?></td>
			<td><strong><?php echo JText::_('Removed'); ?></strong></td>
		</tr>
		<?php if (count($status->modules)) : ?>
		<tr>
			<th><?php echo JText::_('Module'); ?></th>
			<th><?php echo JText::_('Client'); ?></th>
			<th></th>
		</tr>
		<?php foreach ($status->modules as $module) : ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo $module['name']; ?></td>
			<td class="key"><?php echo ucfirst($module['client']); ?></td>
			<td><strong><?php echo ($module['result'])?JText::_('Removed'):JText::_('Not removed'); ?></strong></td>
		</tr>
		<?php endforeach;?>
		<?php endif;?>
		<?php if (count($status->plugins)) : ?>
		<tr>
			<th><?php echo JText::_('Plugin'); ?></th>
			<th><?php echo JText::_('Group'); ?></th>
			<th></th>
		</tr>
		<?php foreach ($status->plugins as $plugin) : ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo ucfirst($plugin['name']); ?></td>
			<td class="key"><?php echo ucfirst($plugin['group']); ?></td>
			<td><strong><?php echo ($plugin['result'])?JText::_('Removed'):JText::_('Not removed'); ?></strong></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>