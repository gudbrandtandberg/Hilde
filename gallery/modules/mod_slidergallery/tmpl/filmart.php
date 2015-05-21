<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); ?>



<?php

include("modules/mod_slidergallery/includes/param.php");

		$db	=& JFactory::getDBO();
		$query = 'SELECT * FROM #__content WHERE catid='.$catid.' AND state=1';
		$db->setQuery($query, 0);
		$rows = $db->loadObjectList();

include("modules/mod_slidergallery/includes/head.php");
?>

<link rel="stylesheet" href="<?php echo JURI::root(); ?>modules/mod_slidergallery/css/image-slideshow.css" type="text/css">



<div id="slidergallery" style="width:<?php echo $width; ?>px; ">

	

	<div id="galleryContainer" style="background:<?php echo $bgcolor; ?>">

		<div id="arrow_left"><img src="<?php echo JURI::root(); ?>modules/mod_slidergallery/images/arrow_left.gif"></div>

		<div id="arrow_right"><img src="<?php echo JURI::root(); ?>modules/mod_slidergallery/images/arrow_right.gif"></div>

		<div id="theImages">

				<!-- Thumbnails -->

                <?php
					for($x=0; $x < $totimg; $x++)
					{
						 $size = getimagesize($imgdir.'/'.$a_img[$x]);										

						 $halfwidth = ceil($size[0]/2);

						 $halfheight = ceil($size[1]/2);

						 $link = "index.php";

						 foreach($rows as $row){

						 	$img_cap = explode(".",$a_img[$x]);

							

							$alias = $row->alias;

							$img_name = str_replace(" ","-",$img_cap[0]);

							$img_name = strtolower($img_name);

							

							if($alias == $img_name){

								$link = "index.php?option=com_content&view=article&id=".$row->id;

							}

						 }

				?>

                                 

				 <a href="<?php echo $link; ?>" ><img src="<?php echo $imgdir."/".$a_img[$x]; ?>" height="<?php echo $filmlStripHeight; ?>"></a>

				<?php } ?>                

				<!-- End thumbnails -->				

				<!-- Image captions -->				

                <?php

				if($totimg !== 0)

				{

                	for($x=0; $x < $totimg; $x++)

					{

						 $size = getimagesize($imgdir.'/'.$a_img[$x]);						

						 

						 $temp = explode(".",$a_img[$x]);

						 

                ?>

                	<div class="imageCaption"><?php echo $temp[0]; ?></div>

                <?php } 

				}

				else

				{

					echo "No images found!";

				}

				?>

				<!-- End image captions -->				

				<div id="slideEnd"></div>

		</div>

	</div>    

</div>

<?php if($credits) { ?>
<div id="link" style="color:<?php echo $color; ?>; width:<?php echo $width; ?>px"; class="<?php echo $color;?>"><a href="http://yashvyas.in" target="_blank">Yash Vyas</a></div>
<?php } ?>