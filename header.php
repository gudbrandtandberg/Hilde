<?php
    if (!isset($_SESSION)) session_start();
    
    if (!isset($_SESSION["lang"])) {	
	$_SESSION["lang"] = "no";
    }
    
    $lang = $_SESSION["lang"];
    include($lang.".strings.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title><?=$title;?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Hilde Morris horse and dog portrait artist. See art, request commisions.">
    <link rel="shortcut icon" href="images/diverse/ikon1.ico">
	
    <!--JQuery-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <!--Slick CSS-->
    <link rel="stylesheet" type="text/css" href="scripts/slick/slick.css">
    <!--Bootstrap JS-->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <!-- Blueimp CSS -->
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <!-- Bootstrap image gallery CSS -->
    <link rel="stylesheet" href="scripts/bootstrap_image_gallery/css/bootstrap-image-gallery.min.css">
    <!--style.css-->
    <link rel="stylesheet" href="style.css"></link>
    <script>
	$(document).ready(function(){

	    $('.dropdown-toggle').dropdown()
	    
	    $(".toggle-lang").click(function(e){
		e.preventDefault();
		$.ajax("toggle-lang.php", {success: function(data){
		    location.reload();
		}});
	    });
	});
    </script>
</head>

<body>
    <div id="wrapper">
    <div id="header">
        <h1>
            <?=$title;?>
        </h1>
	<nav class="navbar navbar-default">
	    <div class="navbar-header"></div>
	    <ul class="nav navbar-nav">
		<li><a id="home" href="index.php"><?=$home;?></a></li>
		<li class="dropdown">
		    <a href="gallerynav.php"><?=$gallery;?></a> 
		    <ul class="dropdown-menu" role="menu">
			<li><a href="gallery.php?page=horses"><?=$horses;?></a></li>
			<li><a href="gallery.php?page=dogs"><?=$dogs;?></a></li>
			<li><a href="gallery.php?page=other"><?=$other;?></a></li>
		    </ul>
		</li>
		<li><a href="process.php"><?=$process;?></a></li>
		<li><a href="about.php"><?=$about;?></a></li>
		<li><a href="contact.php"><?=$contact;?></a></li>
	    </ul>
	</nav>

    </div>
