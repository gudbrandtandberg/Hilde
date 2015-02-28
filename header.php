<!DOCTYPE html>
<html>
<head>
    <title>Hilde Morris Equestrian Artist</title>
    <meta charset="UTF-8">
    
    <!--JQuery-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <!--Bootstrap JS-->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <!--Style.css-->
    <link rel="stylesheet" href="style.css"></link>
    
    <!-- Hvorfor virker ikke de lokale filene! -->
    <!--<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>-->
    <!--<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"></link>-->
    <script>
	$(document).ready(function(){
	    $('.dropdown-toggle').dropdown()
	});
    </script>
</head>

<body>  
    <div id="header">
        <h1>
            HILDE MORRIS HORSE & DOG PORTRAITURE
        </h1>
	<nav class="navbar navbar-default">
	    <ul class="nav navbar-nav">
		<li><a id="home" href="index.php">HOME</a></li>
		<li class="dropdown">
		    <a href="gallerynav.php">GALLERY</a> 
		    <ul class="dropdown-menu" role="menu">
			<li><a href="gallery.php?page=horses">HORSES</a></li>
			<li><a href="gallery.php?page=dogs">DOGS</a></li>
			<li><a href="gallery.php?page=other">OTHER</a></li>
		    </ul>
		</li>
		<li><a href="process.php">PROCESS</a></li>
		<li><a href="about.php">ABOUT THE ARTIST</a></li>
		<li><a href="contact.php">CONTACT</a></li>
	    </ul>
	</nav>

    </div>
