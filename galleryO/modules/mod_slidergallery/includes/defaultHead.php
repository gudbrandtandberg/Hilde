<style>
	#previewPane, #galleryContainer{
		border:<?php echo $border; ?>
	}
	#previewPane img, #waitMessage{
		height:<?php if($show_caption) {echo $height-40;} else {echo $height-12;} ?>px;
		width:<?php echo $width-$border_thickness-24; ?>px;
		border:none;
	}
	#previewPane a{ background:none;}
	#galleryContainer{
		height:<?php echo $filmlStripHeight; ?>px;	/* Height of the images + 2 */
		/*border:1px solid #CCCCCC;*/
		position:relative;
		overflow:hidden;
		padding:1px;
		/* CSS HACK */
		height: <?php echo $filmlStripHeight + 2; ?>px;	/* IE 5.x - Added 2 pixels for border left and right */
		height/* */:/**/<?php echo $filmlStripHeight; ?>px;	/* Other browsers */
		height: /**/<?php echo $filmlStripHeight; ?>px;
	}
	#arrow_right,#arrow_left{ height:<?php echo $filmlStripHeight; ?>px;}
	#arrow_right img,#arrow_left img{ padding-top:<?php echo ($filmlStripHeight-100)/2; ?>px}
</style>
<?php

				$imgdir = $path;  //'modules/mod_slidergallery/gallery';  the directory, where your images are stored
				$allowed_types = array('png','jpg','jpeg','gif'); // list of filetypes you want to show
				$dimg = opendir($imgdir);
				
				while($imgfile = readdir($dimg)){
				 if(in_array(strtolower(substr($imgfile,-3)),$allowed_types)){
					  $a_img[] = $imgfile;
	 				  //reset ($a_img);
				 } 
				}

				if($sort == "asc"){	sort($a_img); } else { rsort($a_img); }
				$totimg = count($a_img); // total image number

				if($totimg){
					for($x=0; $x < $totimg; $x++){
						 $size = getimagesize($imgdir.'/'.$a_img[$x]);						
						 $halfwidth = ceil($size[0]/2);
						 $halfheight = ceil($size[1]/2);						 
				    }
				}
?>

<?php if($shadowbox) { ?>

<script type="text/javascript" src="<?php echo JURI::root(); ?>modules/mod_slidergallery/js/shadowbox.js"></script>
<script type="text/javascript">
	Shadowbox.init();
</script>

<link rel="stylesheet" type="text/css" href="<?php echo JURI::root(); ?>modules/mod_slidergallery/css/shadowbox.css">

<?php } ?>

<script src="<?php echo JURI::root(); ?>modules/mod_slidergallery/js/image-slideshow.js" language="JavaScript1.2"></script>
<script>
	function showPreview(imagePath,imageIndex){
		var subImages = document.getElementById('previewPane').getElementsByTagName('IMG');
		var anchImg = document.getElementById('previewImage');
		if(subImages.length==0){
			var img = document.createElement('IMG');
			//var a = document.createElement('A');
			//document.getElementById('previewPane').appendChild(a);
			document.getElementById('previewPane').appendChild(img);
		}else img = subImages[0];
		if(displayWaitMessage){
			document.getElementById('waitMessage').style.display='inline';
		}
		<?php if($show_caption) {?>
			document.getElementById('largeImageCaption').style.display='none';
		<?php } ?>

		img.onload = function() { hideWaitMessageAndShowCaption(imageIndex-1); };		

		img.src = imagePath;
	}

	function hideWaitMessageAndShowCaption(imageIndex)
	{
		document.getElementById('waitMessage').style.display='none';	
		<?php if($show_caption) {?>
			document.getElementById('largeImageCaption').innerHTML = imageGalleryCaptions[imageIndex];
			document.getElementById('largeImageCaption').style.display='block';
		<?php } ?>
	}
	window.onload = initSlideShow;
</script>