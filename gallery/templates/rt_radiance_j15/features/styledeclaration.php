<?php
/**
 * @package		Gantry Template Framework - RocketTheme
 * @version		1.2 April 25, 2012
 * @author		RocketTheme http://www.rockettheme.com
 * @copyright 	Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureStyleDeclaration extends GantryFeature {
    var $_feature_name = 'styledeclaration';

    function isEnabled() {
        global $gantry;
        $menu_enabled = $this->get('enabled');

        if (1 == (int)$menu_enabled) return true;
        return false;
    }
    
function init() {
        global $gantry;
		$browser = $gantry->browser;

        // COLORCHOOSER

        // Header
        $css = '#rt-header, .menutop li > .item, #rt-showcase .roktabs-links li, #rt-top, #rt-top a:hover, #rt-header .module-content a:hover {color:'.$gantry->get('topblock-text').';}'."\n";
        $css .= '#rt-header a, .menutop li > .item:hover, .menutop li.active > .item, .menutop li.f-mainparent-itemfocus > .item, .menutop li.f-menuparent-itemfocus > .item, #rt-showcase .roktabs-links li.active {color:'.$gantry->get('topblock-link').';}'."\n";
        $css .= '#rt-showcase .roktabs-wrapper .roktabs-links, #rt-showcase .roktabs-wrapper .active-arrows, #rt-accessibility #rt-buttons .button {background-color:'.$this->_RGBA($gantry->get('topblock-background'), '0.65').';}'."\n";
        if ($gantry->browser->name == 'ie' && ($gantry->browser->shortversion == '7' || $gantry->browser->shortversion == '8')) {
            $css .= '#rt-top-burst, #rt-showcase .roktabs-wrapper .roktabs-links, #rt-showcase .roktabs-wrapper .active-arrows {background-color:'.$gantry->get('topblock-background').';}'."\n";
        }
		
		// Main	
        $css .= 'body {background-color:'.$gantry->get('main-background').';}'."\n";
        $css .= 'body, body a:hover, #rt-showcase, #rt-footer-surround, #rt-footer, #rt-copyright, .rt-sidebar-surround, .rt-sidebar-surround .inputbox, body #roktwittie .info, .rt-sidebar-surround .roktabs-wrapper .roktabs-container-inner, #rt-showcase .roktabs-wrapper .roktabs-container-inner {color:'.$gantry->get('main-text').';}'."\n";
        $css .= '.rt-sidebar-surround a, .main-overlay .title span, .main-overlay .readon {color:'.$gantry->get('main-link').';}'."\n";
        if ($gantry->get('main-surround') == 'transparent'){
        	$css .= '#rt-container-bg {background-color: transparent;}'."\n";
        } else {
        	$css .= '#rt-container-bg {background-color:'.$this->_RGBA($gantry->get('main-surround'), '0.8').';}'."\n";
		}
        if ($gantry->browser->name == 'ie' && ($gantry->browser->shortversion == '6' || $gantry->browser->shortversion == '7' || $gantry->browser->shortversion == '8')) {
            $css .= '#rt-container-bg {background-color:'.$gantry->get('main-surround').';}'."\n";
        }

        // Accent
        $css .= '#rt-feature, .rt-sidebar-surround .box2 .rt-block, .component-content .module-title, #rt-content-top .title2 .module-title, #rt-content-bottom .title2 .module-title, .readon:hover, .topblock-overlay-dark .readon:hover, .main-overlay-dark .main-overlay .readon:hover, .accent-overlay-dark .readon:hover, .content-overlay-dark .readon:hover, .bottomblock-overlay-dark .readon:hover, body #roktwittie .header, body .roknewspager-pages .roknewspager-numbers li.active, body .roknewspager-li .roknewspager-h3 {background-color:'.$gantry->get('accent-color').';}'."\n";
        $css .= 'a, .readon, .readon .button, #rt-feature .readon, .rt-sidebar-surround .box2 .readon, #rt-top-surround .readon, #rt-top a, #rt-header .module-content a, #rt-top .title span, #rt-header .title span {color:'.$gantry->get('accent-color').';}'."\n";
        $css .= 'body ul.checkmark li:after, body ul.circle-checkmark li:before, body ul.square-checkmark li:before, body ul.circle-small li:after, body ul.circle li:after, body ul.circle-large li:after {border-color:'.$gantry->get('accent-color').';}'."\n";
        $css .= '.component-content .module-title:before, #rt-content-top .title2 .module-title:before, #rt-content-bottom .title2 .module-title:before {border-top-color:'.$gantry->get('accent-color').';}'."\n";
        $css .= 'body ul.triangle-small li:after, body ul.triangle li:after, body ul.triangle-large li:after {border-left-color:'.$gantry->get('accent-color').';}'."\n";
	    $css .= '.rg-detail-img-bg,.rg-grid-view .rg-grid-thumb,.rg-list-view .rg-list-thumb {border-bottom-color:'.$gantry->get('accent-color').';}'."\n";
        $css .= '#rt-feature, .rt-sidebar-surround .box2, #rt-content-top .title2 .title, #rt-content-bottom .title2 .title, .readon:hover span, .readon:hover .button, #rt-main-column .component-content .title a:hover, #rt-main-column .component-content .title, #rt-main-column .component-content .title a, .main-overlay .box2 .title span {color:'.$gantry->get('accent-text').';}'."\n";
        $css .= '#rt-feature a, .rt-sidebar-surround .box2 a, #rt-content-top .title2 .title span, #rt-content-bottom .title2 .title span, .roknewspager .roknewspager-title, #rt-feature .title span, #rt-feature .readon {color:'.$gantry->get('accent-link').';}'."\n";

        $css .= 'body .root-sub a, body #rt-menu .root.active .item  span {color: '.$gantry->get('accent-color').' !important;}'."\n";

        // Content
        $css .= '#rt-content-top, .component-block, #rt-content-bottom, .rt-sidebar-surround .box1 .rt-block, #rt-breadcrumbs, .content-tabs .roktabs-wrapper .roktabs-links ul li.active, .content-tabs .roktabs-wrapper .roktabs-links ul li:hover span, .content-tabs .roktabs-wrapper .roktabs-container-inner, .rg-detail-img-bg, .rg-grid-view .rg-grid-thumb, .rg-list-view .rg-list-thumb, .rokbox-clean #rokbox-middle .rokbox-right, .rg-view-selector-list .active {background-color:'.$gantry->get('content-background').';}'."\n";
        $css .= '#rt-main-column, #rt-main-column a:hover, #rt-breadcrumbs a:hover, .rt-sidebar-surround .box1 .rt-block, .content-tabs .roktabs-wrapper .roktabs-container-inner, #rt-breadcrumbs, .rt-article-links h3.title, #rt-popuplogin, #mailto-window, #rt-popup, #rt-popuplogin, #rt-popup a:hover, #rt-popuplogin a:hover {color:'.$gantry->get('content-text').';}'."\n";
        $css .= '#rt-main-column a, .rt-sidebar-surround .box1 .rt-block a,.rg-list-view .item-title,.rg-grid-view .item-title, .rg-detail-item-title, .content-tabs .roktabs-wrapper .roktabs-links ul li.active span, #rt-breadcrumbs a, #rt-content-top .title span, #rt-content-bottom .title span, #rt-popup a, #rt-popuplogin a {color:'.$gantry->get('content-link').';}'."\n";
	
        // Bottom
        $css .= '#rt-bottom {background-color:'.$gantry->get('bottomblock-background').';}'."\n";
        $css .= '#rt-bottom, #rt-bottom a:hover {color:'.$gantry->get('bottomblock-text').';}'."\n";
        $css .= '#rt-bottom a, #rt-bottom .title span {color:'.$gantry->get('bottomblock-link').';}'."\n";

        // Gradients
        $css .= '.menutop li.active.root, .menutop li.root:hover, .menutop li.f-mainparent-itemfocus, .menutop li.active.root:before, .menutop li.active.root:after, .rt-splitmenu .menutop li.active, .rt-splitmenu .menutop li:hover, .rt-splitmenu .menutop li.active:before, .rt-splitmenu .menutop li.active:after {'.$this->_createGradient('top', $gantry->get('accent-color'), '0', '0%', $gantry->get('accent-color'), '1', '70%').'}'."\n";
        $css .= '.grad-left {'.$this->_createGradient('left', $gantry->get('main-background'), '1', '0%', $gantry->get('main-background'), '0', '100%').'}'."\n";
        $css .= '.grad-right {'.$this->_createGradient('left', $gantry->get('main-background'), '0', '0%', $gantry->get('main-background'), '1', '100%').'}'."\n";
        $css .= '.grad-bottom {'.$this->_createGradient('top', $gantry->get('main-background'), '0', '0%', $gantry->get('main-background'), '1', '100%').'}'."\n";
        if ($gantry->browser->name == 'ie' && $gantry->browser->shortversion == '9') {
            $css .= '#rt-top-burst {background-color:'.$this->_RGBA($gantry->get('topblock-background'), '0.65').';}'."\n";
        } else {
            $css .= '#rt-top-burst {'.$this->_createGradient('top', $gantry->get('topblock-background'), '0.55', '0%', $gantry->get('topblock-background'), '0.65', '45%').'}'."\n";
        }
        
        // Backgrounds
        $css .= $this->buildBackground();

        // Static file
        if ($gantry->get('static-enabled')) {
            // do file stuff
            jimport('joomla.filesystem.file');
            $filename = $gantry->templatePath.DS.'css'.DS.'static-styles.css';

            if (file_exists($filename)) {
                if ($gantry->get('static-check')) {
                    //check to see if it's outdated

                    $md5_static = md5_file($filename);
                    $md5_inline = md5($css);

                    if ($md5_static != $md5_inline) {
                        JFile::write($filename, $css);
                    }
                }
            } else {
                // file missing, save it
                JFile::write($filename, $css);
            }
            // add reference to static file
            $gantry->addStyle('static-styles.css',99);

        } else {
            // add inline style
            $gantry->addInlineStyle($css);
        }
        

		$this->_disableRokBoxForiPhone();

		// Style Inclusion
		$cssstyle = $gantry->get('cssstyle');
		$gantry->addStyle($cssstyle.".css");
		$gantry->addStyle('overlays.css');
		$bodystyle = $gantry->get('body-background');
		$gantry->addStyle('bodystyle-'.$bodystyle.'.css');
		if ($gantry->get('typography-enabled')) $gantry->addStyle('typography.css');
		if ($gantry->get('extensions')) $gantry->addStyle('extensions.css');
        if ($gantry->get('extensions')) $gantry->addStyle('extensions-overlays.css');
		if ($gantry->get('extensions')) $gantry->addStyle('extensions-body-'.$bodystyle.'.css');
		if ($gantry->get('thirdparty')) $gantry->addStyle('thirdparty.css');

	}

    function buildBackground(){
        global $gantry;

        if (!$gantry->get('background-enabled')) return "";

        $source = $width = $height = "";

        $background = str_replace("&quot;", '"', str_replace("'", '"', $gantry->get('background-image')));
        $data = json_decode($background);

        if (!$data){
            if (strlen($background)) $source = $background;
            else return "";
        } else {
            $source = $data->path;
        }

        if (substr($gantry->baseUrl, 0, strlen($gantry->baseUrl)) == substr($source, 0, strlen($gantry->baseUrl))){
            $file = JPATH_ROOT . DS . substr($source, strlen($gantry->baseUrl));
        } else {
            $file = JPATH_ROOT . DS . $source;
        }

        if (isset($data->width) && isset($data->height)){
            $width = $data->width;
            $height = $data->height;
        } else {
            $size = @getimagesize($file);
            $width = $size[0];
            $height = $size[1];
        }


        if (!preg_match('/^\//', $source))
        {
            $source = JURI::root(true).'/'.$source;
        }

        $output = "";
        $output .= "#rt-bg-image {background: url(".$source.") 50% 0 no-repeat;}"."\n";
        $output .= "#rt-bg-image {position: absolute; width: ".$width."px;height: ".$height."px;top: 0;left: 50%;margin-left: -".($width / 2)."px;}"."\n";

        $file = preg_replace('/\//i', DS, $file);

        return (file_exists($file)) ? $output : '';
    }

    function _createGradient($direction, $from, $fromOpacity, $fromPercent, $to, $toOpacity, $toPercent){
        global $gantry;
        $browser = $gantry->browser;

        $fromColor = $this->_RGBA($from, $fromOpacity);
        $toColor = $this->_RGBA($to, $toOpacity);
        $gradient = $default_gradient = '';

        $default_gradient = 'background: linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';

        switch ($browser->engine) {
            case 'gecko':
                $gradient = ' background: -moz-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
                break;

            case 'webkit':
                if ($browser->shortversion < '5.1'){
                    
                    switch ($direction){
                        case 'top':
                            $from_dir = 'left top'; $to_dir = 'left bottom'; break;
                        case 'bottom':
                            $from_dir = 'left bottom'; $to_dir = 'left top'; break;
                        case 'left':
                            $from_dir = 'left top'; $to_dir = 'right top'; break;
                        case 'right':
                            $from_dir = 'right top'; $to_dir = 'left top'; break;
                    }
                    $gradient = ' background: -webkit-gradient(linear, '.$from_dir.', '.$to_dir.', color-stop('.$fromPercent.','.$fromColor.'), color-stop('.$toPercent.','.$toColor.'));';
                } else {
                    $gradient = ' background: -webkit-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
                }
                break;

            case 'presto':
                $gradient = ' background: -o-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
                break;

            case 'trident':
                if ($browser->shortversion >= '10'){
                    $gradient = ' background: -ms-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
                } else if ($browser->shortversion <= '6'){
                    $gradient = $from;
                    $default_gradient = '';
                } else {

                    $gradient_type = ($direction == 'left' || $direction == 'right') ? 1 : 0;
                    $from_nohash = str_replace('#', '', $from);
                    $to_nohash = str_replace('#', '', $to);

                    if (strlen($from_nohash) == 3) $from_nohash = str_repeat(substr($from_nohash, 0, 1), 6);
                    if (strlen($to_nohash) == 3) $to_nohash = str_repeat(substr($to_nohash, 0, 1), 6);

                    if ($fromOpacity == 0 || $fromOpacity == '0' || $fromOpacity == '0%') $from_nohash = '00' . $from_nohash;
                    if ($toOpacity == 0 || $toOpacity == '0' || $toOpacity == '0%') $to_nohash = '00' . $to_nohash;

                    $gradient = " filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#".$from_nohash."', endColorstr='#".$to_nohash."',GradientType=".$gradient_type." );";

                    $default_gradient = '';
                    
                }
                break;

            default:
                $gradient = $from;
                $default_gradient = '';
                break;
        }

        return  $default_gradient . $gradient;
    }

    function _HEX2RGB($hexStr, $returnAsString = false, $seperator = ','){
        $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);
        $rgbArray = array();
    
        if (strlen($hexStr) == 6){
            $colorVal = hexdec($hexStr);
            $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
            $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
            $rgbArray['blue'] = 0xFF & $colorVal;
        } elseif (strlen($hexStr) == 3){
            $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
            $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
            $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
        } else {
            return false;
        }
    
        return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray;
    }
    
    function _RGBA($hex, $opacity){
        return 'rgba(' . $this->_HEX2RGB($hex, true) . ','.$opacity.')';
    }

	function _disableRokBoxForiPhone() {
		global $gantry;

		if ($gantry->browser->platform == 'iphone') {
			$gantry->addInlineScript("window.addEvent('domready', function() {\$\$('a[rel^=rokbox]').removeEvents('click');});");
		}
	}

}