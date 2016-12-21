<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2011 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 *  @version $Id: install.admintools.php 202 2011-03-09 16:19:36Z nikosdion $
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

// Joomla! 1.6 Beta 13+ hack
if( version_compare( JVERSION, '1.6.0', 'ge' ) && !defined('_AKEEBA_HACK') ) {
	return;
} else {
	global $akeeba_installation_has_run;
	if($akeeba_installation_has_run) return;
}

$db = JFactory::getDBO();

// Version 1.0.b1 to 1.0.RC1 updates (performs autodection before running the commands)
// for #__admintools_ipblock
$sql = 'SHOW CREATE TABLE `#__admintools_ipblock`';
$db->setQuery($sql);
$ctableAssoc = $db->loadResultArray(1);
$ctable = empty($ctableAssoc) ? '' : $ctableAssoc[0];
if(!strstr($ctable, '`description`'))
{
	if($db->hasUTF())
	{
		$charset = 'CHARSET=utf8';
	}
	else
	{
		$charset = '';
	}

	$sql = <<<ENDSQL
DROP TABLE IF EXISTS `#__admintools_ipblock_bak`;
ENDSQL;
	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}

$sql = <<<ENDSQL
CREATE TABLE IF NOT EXISTS `#__admintools_ipblock_bak` (
	`id` SERIAL,
	`ip` VARCHAR(255),
	`description` VARCHAR(255)
) DEFAULT COLLATE utf8_general_ci;

ENDSQL;
	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}

	$sql = <<<ENDSQL
INSERT IGNORE INTO `#__admintools_ipblock_bak`
	(`id`,`ip`,`description`)
SELECT `id`,`ip`, '' as `description` FROM `#__admintools_ipblock`;
ENDSQL;
	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}

	$sql = <<<ENDSQL
DROP TABLE IF EXISTS `#__admintools_ipblock`;
ENDSQL;
	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}


	$sql = <<<ENDSQL
CREATE TABLE IF NOT EXISTS `#__admintools_ipblock` (
	`id` SERIAL,
	`ip` VARCHAR(255),
	`description` VARCHAR(255)
) DEFAULT COLLATE utf8_general_ci;

ENDSQL;

	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}

	$sql = <<<ENDSQL
INSERT IGNORE INTO `#__admintools_ipblock` SELECT * FROM `#__admintools_ipblock_bak`;
ENDSQL;
	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}

	$sql = <<<ENDSQL
DROP TABLE IF EXISTS `#__admintools_ipblock_bak`;
ENDSQL;
	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}

}

// Version 1.0.b1 to 1.0.RC1 updates (performs autodection before running the commands)
// for #__admintools_adminiplist
$sql = 'SHOW CREATE TABLE `#__admintools_adminiplist`';
$db->setQuery($sql);
$ctableAssoc = $db->loadResultArray(1);
$ctable = empty($ctableAssoc) ? '' : $ctableAssoc[0];
if(!strstr($ctable, '`description`'))
{
	if($db->hasUTF())
	{
		$charset = 'CHARSET=utf8';
	}
	else
	{
		$charset = '';
	}

	$sql = <<<ENDSQL
DROP TABLE IF EXISTS `#__admintools_adminiplist_bak`;
ENDSQL;
	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}

$sql = <<<ENDSQL
CREATE TABLE IF NOT EXISTS `#__admintools_adminiplist_bak` (
	`id` SERIAL,
	`ip` VARCHAR(255),
	`description` VARCHAR(255)
) DEFAULT COLLATE utf8_general_ci;

ENDSQL;
	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}

	$sql = <<<ENDSQL
INSERT IGNORE INTO `#__admintools_adminiplist_bak`
	(`id`,`ip`,`description`)
SELECT `id`,`ip`, '' as `description` FROM `#__admintools_adminiplist`;
ENDSQL;
	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}

	$sql = <<<ENDSQL
DROP TABLE IF EXISTS `#__admintools_adminiplist`;
ENDSQL;
	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}


	$sql = <<<ENDSQL
CREATE TABLE IF NOT EXISTS `#__admintools_adminiplist` (
	`id` SERIAL,
	`ip` VARCHAR(255),
	`description` VARCHAR(255)
) DEFAULT COLLATE utf8_general_ci;

ENDSQL;

	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}

	$sql = <<<ENDSQL
INSERT IGNORE INTO `#__admintools_adminiplist` SELECT * FROM `#__admintools_adminiplist_bak`;
ENDSQL;
	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}

	$sql = <<<ENDSQL
DROP TABLE IF EXISTS `#__admintools_adminiplist_bak`;
ENDSQL;
	$db->setQuery($sql);
	$status = $db->query();
	if(!$status && ($db->getErrorNum() != 1060)) {
		$errors[] = $db->getErrorMsg(true);
	}

}

// Modules & plugins installation

jimport('joomla.installer.installer');
$db = & JFactory::getDBO();
$status = new JObject();
$status->modules = array();
$status->plugins = array();
if( version_compare( JVERSION, '1.6.0', 'ge' ) ) {
	if(!isset($parent))
	{
		$parent = $this->parent;
	}
	$src = $parent->getParent()->getPath('source');
} else {
	$src = $this->parent->getPath('source');
}

$installer = new JInstaller;
$result = $installer->install($src.DS.'mod_atjupgrade');
$status->modules[] = array('name'=>'mod_atjupgrade','client'=>'administrator', 'result'=>$result);

$query = "UPDATE #__modules SET position='icon', ordering=98, published=1 WHERE `module`='mod_atjupgrade'";
$db->setQuery($query);
$db->query();


$installer = new JInstaller;
$result = $installer->install($src.DS.'plg_admintools');
$status->plugins[] = array('name'=>'plg_admintools','group'=>'system', 'result'=>$result);

if( version_compare( JVERSION, '1.6.0', 'ge' ) ) {
	$query = "UPDATE #__extensions SET ordering=-30000 WHERE element='admintools' AND folder='system'";
	$db->setQuery($query);
	$db->query();

	$query = "UPDATE #__extensions SET enabled=1 WHERE element='admintools' AND folder='system'";
	$db->setQuery($query);
	$db->query();
} else {
	$query = "UPDATE #__plugins SET ordering=-30000 WHERE element='admintools' AND folder='system'";
	$db->setQuery($query);
	$db->query();

	$query = "UPDATE #__plugins SET published=1 WHERE element='admintools' AND folder='system'";
	$db->setQuery($query);
	$db->query();
}

?>

<?php $rows = 0;?>
<img src="../media/com_admintools/images/admintools-48.png" width="48" height="48" alt="Admin Tools" align="right" />
<h2><?php echo JText::_('Admin Tools Installation Status'); ?></h2>
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
			<td><strong><?php echo JText::_('Installed'); ?></strong></td>
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
			<td><strong><?php echo ($module['result'])?JText::_('Installed'):JText::_('Not installed'); ?></strong></td>
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
			<td><strong><?php echo ($plugin['result'])?JText::_('Installed'):JText::_('Not installed'); ?></strong></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>