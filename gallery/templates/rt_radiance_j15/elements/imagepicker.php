<?php
/**
 * @package     gantry
 * @subpackage  admin.elements
 * @version        1.2 April 25, 2012
 * @author        RocketTheme http://www.rockettheme.com
 * @copyright     Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license        http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();
/**
 * @package     gantry
 * @subpackage  admin.elements
 */

jimport('joomla.application.component.helper');
class JElementImagePicker extends JElement {

	function fetchElement($name, $value, &$node, $control_name) {
		JHTML::_('behavior.modal');
		JHTML::_('behavior.media');
		global $gantry;

		$com_rokgallery = JComponentHelper::getComponent('com_rokgallery');
		$layout = $link = $dropdown = "";
		$options = $choices = array();
		$nomargin = false;
		$rokgallery = ($com_rokgallery->params !== null) ? true : false;
		//$rokgallery = false; // debug

		$value = str_replace("'", '"', $value);
		$data = json_decode($value);
		if (!$data && strlen($value)){
			$nomargin = true;
			$data = json_decode('{"path":"'.$value.'"}');
		}
		$preview = "";
		$preview_width = 'width="50"';
		$preview_height = 'height="50"';

		if (!$data && (!isset($data->preview) || !isset($data->path))) $preview = $gantry->templateUrl . '/elements/imagepicker/images/no-image.jpg';
		else if (isset($data->preview)) $preview = $data->preview;
		else {
			$preview = JURI::root(true) . '/' . $data->path;
			$preview_height = "";
		}


		if (!defined('ELEMENT_RTIMAGEPICKER')){
			gantry_addStyle($gantry->templateUrl . '/elements/imagepicker/css/imagepicker.css');

			gantry_addInlineScript("
			if (typeof jInsertEditorText == 'undefined'){
				function jInsertEditorText(text, editor) {
					var source = text.match(/(src)=(\"[^\"]*\")/i), img;
					text = source[2].replace(/\\\"/g, '');
					img = '".JURI::root(true)."/' + text;

					document.getElementById(editor + '-img').src = img;
					document.getElementById(editor + '-img').removeProperty('height');
					document.getElementById(editor).value = JSON.encode({path: text});

					if (Gantry.MenuItemHead) {
						var cache = Gantry.MenuItemHead.Cache[Gantry.Selection];
						if (!cache) cache = new Hash({});
						cache.set('".$name."', document.getElementById(editor).value);
					}
				};
			};
			");

			gantry_addInlineScript("
				var GalleryPickerInsertText = function(input, string, size, minithumb){
					var data = {
						path: string,
						width: size.width,
						height: size.height,
						preview: minithumb
					};

					document.getElementById(input + '-img').src = minithumb;
					document.getElementById(input + '-infos').innerHTML = data.width + ' x ' + data.height;
					document.getElementById(input).value = JSON.encode(data);

					if (Gantry.MenuItemHead) {
						var cache = Gantry.MenuItemHead.Cache[Gantry.Selection];
						if (!cache) cache = new Hash({});
						cache.set('".$name."', document.getElementById(input).value);
					}
				};

				var empty_background_img = '".$gantry->templateUrl."/elements/imagepicker/images/no-image.jpg';
				window.addEvent('domready', function(){
					$('params".$name."').addEvent('set', function(value){
						$('params".$name."-infos').innerHTML = '';
						if (!value || !value.length) $('params".$name."-img').setProperty('src', empty_background_img);
						else {
							var data = JSON.decode(value);
							$('params".$name."-img').setProperty('src', (data.preview ? data.preview : '".JURI::root(true)."/' + data.path));
							if (!data.preview){
								$('params".$name."-img').removeProperty('height');
							} else {
								$('params".$name."-img').setProperty('height', '50');
								if (data.width && data.height) $('params".$name."-infos').innerHTML = data.width + ' x ' + data.height;
							}
						}

						this.setProperty('value', value);
					});

					$('params".$name."-clear').addEvent('click', function(e){
						new Event(e).stop();
						$('params".$name."').setProperty('value', '').fireEvent('set', '');

						if (Gantry.MenuItemHead) {
							var cache = Gantry.MenuItemHead.Cache[Gantry.Selection];
							if (!cache) cache = new Hash({});
							cache.set('".$name."', document.getElementById('params".$name."').value);
						}
					});

					var dropdown = $('params".$name."mediatype');
					if (dropdown){
						dropdown.addEvent('change', function(){
							$('params".$name."-link').setProperty('href', this.value);
						});
					}
				});
			");
            
            define('ELEMENT_RTIMAGEPICKER', true);
        }


        if ($rokgallery) $link = 'index.php?option=com_rokgallery&view=gallerypicker&tmpl=component&show_menuitems=0&inputfield=params' . $name;
        else $link = "index.php?option=com_media&view=images&layout=default&tmpl=component&e_name=params" . $name;

        if ($rokgallery){
			$choices = array(
				array('RokGallery', 'index.php?option=com_rokgallery&view=gallerypicker&tmpl=component&show_menuitems=0&inputfield=params' . $name),
		    	array('MediaManager', 'index.php?option=com_media&view=images&layout=default&tmpl=component&e_name=params' . $name)
		    );

			foreach ($choices as $option){
				$options[] = JHTML::_('select.option', $option[1], $option[0], 'value', 'text');
			}

			include_once($gantry->gantryPath.DS.'admin'.DS.'elements'.DS.'selectbox.php');
			$selectbox = new JElementSelectBox;
			$dropdown = '<div id="'.$name.'-mediadropdown" class="mediadropdown">'.$selectbox->fetchElement($name . 'mediatype', $link, $node, $control_name, $options) ."</div>";
        }

        $value = str_replace('"', "'", $value);
		$layout .= '
			<div class="wrapper">'."\n".'
				<div id="' . $name . '-wrapper" class="backgroundpicker">'."\n".'
					<img id="params'.$name.'-img" class="backgroundpicker-img" '.$preview_width.' '.$preview_height.' alt="" src="'.$preview.'" />
					
					<div id="params'.$name.'-infos" class="backgroundpicker-infos" '.($rokgallery && !$nomargin ? 'style="display:block;"' : 'style="display:none;"').' >'
						.((isset($data->width) && (isset($data->height))) ? $data->width.' x '.$data->height : '').
					'</div>


					<a id="params'.$name.'-link" href="'.$link.'" rel="{handler: \'iframe\', size: {x: 675, y: 450}}" class="bg-button modal">'."\n".'
						<span class="bg-button-right">'."\n".'
							Select
						</span>'."\n".'
					</a>'."\n".'
					<a id="params'.$name.'-clear" href="#" class="bg-button bg-button-clear">'."\n".'
						<span class="bg-button-right">'."\n".'
							Reset
						</span>'."\n".'
					</a>'."\n".'

					'.$dropdown.'

					<input type="hidden" id="params' . $name . '" name="' . $control_name . '[' . $name . ']' . '" value="' . $value . '" />'."\n".'
					<div class="clr"></div>
				</div>'."\n".'
			</div>'."\n".'
		';

		return $layout;
	}
}

?>