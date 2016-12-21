<?php
/**
 * @version 1.1 $Id: mod_rscoolmp3player.php
 * @package Joomla 1.5.x
 * @subpackage RS Cool Mp3 Player is a flash based minimalistic Mp3 player module.
 * @copyright (C) 2010-2015 RS Web Solutions (http://www.rswebsols.com)
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

ini_set('display_errors', 0);
error_reporting(0);

$rsws_module_width = $params->get('rsws_module_width', 290);
$rsws_module_margin = $params->get('rsws_module_margin', 10);
$rsws_width = $params->get('rsws_width', 281);
$rsws_height = $params->get('rsws_height', 78);
$rsws_backgroundColor = $params->get('rsws_backgroundColor', 'ffffff');
$rsws_autoplay = $params->get('rsws_autoplay', 2);
$rsws_margin = $params->get('rsws_margin', 5);
$rsws_strokeColor = $params->get('rsws_strokeColor', '90C84B');
$rsws_fillColor = $params->get('rsws_fillColor', '414042');
$rsws_backColor = $params->get('rsws_backColor', 'FFFFFF');
$rsws_backOverColor = $params->get('rsws_backOverColor', 'DEECBD');
$rsws_signStrokeColor = $params->get('rsws_signStrokeColor', '4B4B4B');
$rsws_signFillColor = $params->get('rsws_signFillColor', '83B04D');
$rsws_initLevel = $params->get('rsws_initLevel', 50);
$rsws_backStrokeColor = $params->get('rsws_backStrokeColor', '4B4B4B');
$rsws_backFillColor = $params->get('rsws_backFillColor', '83B04D');
$rsws_signColor = $params->get('rsws_signColor', 'E7E8E9');
$rsws_signOverColor = $params->get('rsws_signOverColor', '4B4B4B');
$rsws_percentTextColor = $params->get('rsws_percentTextColor', 'E7E8E9');
$rsws_percentTextmarginX = $params->get('rsws_percentTextmarginX', 5);
$rsws_percentTextpositionY = $params->get('rsws_percentTextpositionY', 'top');
$rsws_visualizerbackColor = $params->get('rsws_visualizerbackColor', '4B4B4B');
$rsws_visualizerwavesColor = $params->get('rsws_visualizerwavesColor', 'FFFFFF');
$rsws_artistColor = $params->get('rsws_artistColor', 'E7E8E9');
$rsws_artistFontSize = $params->get('rsws_artistFontSize', 14);
$rsws_songColor = $params->get('rsws_songColor', 'E7E8E9');
$rsws_songFontSize = $params->get('rsws_songFontSize', 12);
$rsws_artistName = $params->get('rsws_artistName', '');
$rsws_songName = $params->get('rsws_songName', '');
$rsws_songURL = $params->get('rsws_songURL', '');
$rsws_use_exact_url = $params->get('rsws_use_exact_url', 2);
$rsws_exact_url = $params->get('rsws_exact_url', '');

if($rsws_use_exact_url == '1') {
	$rsws_website_url = $rsws_exact_url;
	if(substr($rsws_website_url, -1, 1) != '/') {
		$rsws_website_url = $rsws_website_url.'/';
	}
} else {
	$rsws_website_url = JURI::root();
}

$rsws_artistName_EXP = explode(',', $rsws_artistName);
$rsws_songName_EXP = explode(',', $rsws_songName);
$rsws_songURL_EXP = explode(',', $rsws_songURL);

$rsws_tot_counter = count($rsws_songURL_EXP);

if($rsws_tot_counter > 1) {
	$rsws_autoplay = 'false';
} else {
	if($rsws_autoplay == '1') {
		$rsws_autoplay = 'true';
	} else {
		$rsws_autoplay = 'false';
	}
}

// Set FTP credentials, if given
$rsws_module_path = JPATH_BASE.DS.'modules'.DS.'mod_rscoolmp3player'.DS;
jimport('joomla.client.helper');
JClientHelper::setCredentialsFromRequest('ftp');
$ftp = JClientHelper::getCredentials('ftp');

$rsws_file = $rsws_module_path.'xml'.DS.'rscoolmp3player_'.$module->id.'.xml';

$rsws_txt = '<?xml version="1.0" encoding="utf-8"?><settings width="'.$rsws_width.'" height="'.$rsws_height.'"><autoplay>'.$rsws_autoplay.'</autoplay><margin>'.$rsws_margin.'</margin><strokeColor>0x'.$rsws_strokeColor.'</strokeColor><fillColor>0x'.$rsws_fillColor.'</fillColor><playPauseButton><backColor>0x'.$rsws_backColor.'</backColor><backOverColor>0x'.$rsws_backOverColor.'</backOverColor><signStrokeColor>0x'.$rsws_signStrokeColor.'</signStrokeColor><signFillColor>0x'.$rsws_signFillColor.'</signFillColor></playPauseButton><volumeControl initLevel="'.$rsws_initLevel.'"><backStrokeColor>0x'.$rsws_backStrokeColor.'</backStrokeColor><backFillColor>0x'.$rsws_backFillColor.'</backFillColor><signColor>0x'.$rsws_signColor.'</signColor><signOverColor>0x'.$rsws_signOverColor.'</signOverColor><percentText color="0x'.$rsws_percentTextColor.'" marginX="'.$rsws_percentTextmarginX.'" positionY="'.$rsws_percentTextpositionY.'" /></volumeControl><visualizer backColor="0x'.$rsws_visualizerbackColor.'" wavesColor="0x'.$rsws_visualizerwavesColor.'" /><songText><artistColor>0x'.$rsws_artistColor.'</artistColor><artistFontSize>'.$rsws_artistFontSize.'</artistFontSize><songColor>0x'.$rsws_songColor.'</songColor><songFontSize>'.$rsws_songFontSize.'</songFontSize></songText></settings>';

jimport('joomla.filesystem.file');
//if (JFile::exists($rssn_file)) {
	// Try to make the params file writeable
	if (!$ftp['enabled'] && JPath::isOwner($rsws_file) && !JPath::setPermissions($rsws_file, '0755')) {
		JError::raiseNotice('SOME_ERROR_CODE', JText::_('Could not make the file writable'));
	}

	JFile::write($rsws_file, $rsws_txt);

	// Try to make the params file unwriteable
	if (!$ftp['enabled'] && JPath::isOwner($rsws_file) && !JPath::setPermissions($rsws_file, '0555')) {
		JError::raiseNotice('SOME_ERROR_CODE', JText::_('Could not make the file unwritable'));
	}
//}
$rsws_document	=& JFactory::getDocument();
$rsws_document->addScript( JURI::root().'modules/mod_rscoolmp3player/js/swfobject.js');

$rsws_counter = 1;
echo '<div style="width:'.$rsws_module_width.'px;">';
for($rsws_i=1; $rsws_i<=$rsws_tot_counter; $rsws_i++) {
	preg_match_all('|{(.*)}|imU', trim($rsws_artistName_EXP[$rsws_i-1]), $rsws_temp_artist_arr);
	preg_match_all('|{(.*)}|imU', trim($rsws_songName_EXP[$rsws_i-1]), $rsws_temp_song_arr);
	preg_match_all('|{(.*)}|imU', trim($rsws_songURL_EXP[$rsws_i-1]), $rsws_temp_url_arr);
	
	$rsws_temp_artist = trim($rsws_temp_artist_arr[1][0]);
	$rsws_temp_song = trim($rsws_temp_song_arr[1][0]);
	$rsws_temp_url = trim($rsws_temp_url_arr[1][0]);
	
	if(($rsws_temp_artist != '') && ($rsws_temp_song != '') && ($rsws_temp_url != '')) {

		$rsws_js_controller = '<script type="text/javascript">var cacheBuster = "?t=" + Date.parse(new Date()); var stageW = '.$rsws_width.'; var stageH = '.$rsws_height.'; var attributes = {}; attributes.id = \'RSCoolMp3PlayerModule_'.$module->id.'_'.$rsws_counter.'\'; attributes.name = attributes.id; var params = {}; params.wmode = "transparent"; params.allowfullscreen = "true"; params.allowScriptAccess = "always"; params.bgcolor = "#'.$rsws_backgroundColor.'"; var flashvars = {}; flashvars.componentWidth = stageW; flashvars.componentHeight = stageH; flashvars.pathToFiles = ""; flashvars.xmlPath = "'.$rsws_website_url.'modules/mod_rscoolmp3player/xml/rscoolmp3player_'.$module->id.'.xml"; flashvars.artistName = "'.$rsws_temp_artist.'"; flashvars.songName = "'.$rsws_temp_song.'"; flashvars.songURL = "'.$rsws_temp_url.'"; swfobject.embedSWF("'.$rsws_website_url.'modules/mod_rscoolmp3player/swf/preview.swf"+cacheBuster, attributes.id, stageW, stageH, "9.0.124", "'.$rsws_website_url.'modules/mod_rscoolmp3player/swf/expressInstall.swf", flashvars, params);</script>';

		$rsws_html_controller = '<div style="margin-bottom:'.$rsws_module_margin.'px;"><div id="RSCoolMp3PlayerModule_'.$module->id.'_'.$rsws_counter.'"><p>In order to view this object you need Flash Player 9+ support!</p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"/></a><p>'.base64_decode('UG93ZXJlZCBieQ==').' <a href="'.base64_decode('aHR0cDovL3d3dy5yc3dlYnNvbHMuY29t').'" target="_blank">'.base64_decode('UlMgV2ViIFNvbHV0aW9ucw==').'</a></p></div></div>';

		echo $rsws_js_controller;
		echo $rsws_html_controller;
		$rsws_counter++;
	}
}
echo '</div>';
?>