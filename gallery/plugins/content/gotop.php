<?php

/**
* GoTop Joomla! Plugin
*
* @author    cs
* @copyright This plugin is released under the GNU/GPL License
* @license	 GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$mainframe->registerEvent( 'onPrepareContent', 'plgContentGoTop' );

/**
* Plugin that shows a 'Go to top of page' link in the content
*/

function plgContentGoTop( &$row, &$params, $page=0 ) {
	// simple performance check to determine whether plg should process further
	if (JString::strpos($row->text, 'gotop') === false) {
		return true;
	}

	// Get plugin info
	$plugin =& JPluginHelper::getPlugin('content', 'gotop');
 	$pluginParams = new JParameter( $plugin->params );
 	
 	// expression to search for
	$regex = "#{gotop}#s";

	// search for regex and perform the replacement
	preg_match_all($regex, $row->text, $matches);
 	$count = count($matches[0]);
 	if ($count) {
 		plgContentGoTopReplace($row, $matches, $count, $regex, $pluginParams);
	}
}

function plgContentGoTopReplace(&$row, &$matches, $count, $regex, $params) {
  $lnk_txt = $params->get('Ltxt');
  $lnk_img = $params->get('Limg');
  $lnk_width = $params->get('Lwidth');
  $lnk_title = $params->get('Ltitle');
  $lnk_hrabv = $params->get('Lhrabove');
  $lnk_hrblw = $params->get('Lhrbelow');
  $lnk_print = $params->get('Lprint');

  if (!$lnk_print) {
    if (!defined('plg_gotop_css_once')) { /* load only once when multiple instances of plg*/
      $doc =& JFactory::getDocument();
      $css_noprint = '      @media print { .plg_gotop { display: none; }}';
      $doc->addStyleDeclaration($css_noprint);
      define('plg_gotop_css_once', true);
    }}
	for ($i = 0; $i < $count; $i++) {
    if ($lnk_hrabv) $replace = "<hr class=\"plg_gotop\" />"; 
    if (!$lnk_print) $replace .= "<div class=\"plg_gotop\">";
    $replace .= "<a href=\"javascript:;\" onclick=\"window.scrollTo(0,0)\" title=\"".htmlspecialchars($lnk_title)."\" style=\"display: block; width:".$lnk_width.";\">";
    if ($lnk_img == "-1") {
      $replace .= htmlspecialchars($lnk_txt);
    } 
    else {
      $replace .= "<img src=\"".JURI::base(true)."/images/M_images/".$lnk_img."\" />";
    }
    $replace .= "</a>"; 
    if (!$lnk_print) $replace .= "</div>";
    if ($lnk_hrblw) $replace .= "<hr class=\"plg_gotop\" />"; 
    $row->text = str_replace($matches[0][$i], $replace, $row->text);
  }
}
