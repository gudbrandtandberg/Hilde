<?php

$width = $params->get('width','516');
$bgcolor = $params->get('bgcolor','#EFEFEF');
$border_thickness = $params->get('border_thickness','1');
$border_color = $params->get('border_color','#CCCCCC');
$path = $params->get('path','modules/mod_slidergallery/gallery');
$shadowbox = $params->get('shadowbox','0');
$border = $border_thickness."px "."solid ".$border_color;
$show_caption = $params->get('show_caption','1');
$credits = $params->get('credits','1');
$color = $params->get('credits_color','#CCCCCC');
$sort = $params->get('sort','asc');
$filmlStripHeight = $params->get('film_strip_height','102');
$imageGroupId = $params->get('image_group_id','Set1');
if($show_caption){
	$height = $params->get('height','390');
}else{
	$height = $params->get('height','390');
	$height = $height - 34;
}
$catid = $params->get('catid','1');