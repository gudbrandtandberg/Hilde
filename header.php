<!DOCTYPE html>
<html>
<head>
    <title>Hilde Morris Equestrian Artist</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> </link>
    <link rel="stylesheet" href="style.css"></link>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    
    <script type="text/javascript">
        
        $(document).ready(function(){ 
	    var currentMenuItem = "home";
            $(currentMenuItem).css("font-weight", "bold");
           
            $('#menu .menuitem').each(function(){
		wid = $(this).width() + 10;
		$(this).css('width', wid+'px');
	    });
	   
            $("#gallery").hover(function(){
		$('#menu .popupitem').each(function(){
		    wid = $(this).width() + 10;
		    $(this).css('width', 95+'px');
		});
            });
        });   
    </script>
</head>

<body>  
    <div id="banner">
        <h1>
            HILDE MORRIS HORSE & DOG PORTRAITURE
        </h1>

            <ul id="menu">
                <li class="menuitem"><a id="home" href="index.php">HOME</a></li>
                <li class="strek">|</li>
                <li class="menuitem"><a id="gallery" href="gallerynav.php">GALLERY</a> 
                    <ul id="popup">
                        <li class="popupitem"><a href="gallery.php?page=horses">HORSES</a></li>
                        <li class="popupitem"><a href="gallery.php?page=dogs">DOGS</a></li>
			<li class="popupitem"><a href="gallery.php?page=other">OTHER</a></li>
                    </ul>
                </li>
                <li class="strek">|</li>
                <li class="menuitem"><a id="process" href="process.php">PROCESS</a></li>
                <li class="strek">|</li>
                <li class="menuitem"><a id="about" href="about.php">ABOUT THE ARTIST</a></li>
                <li class="strek">|</li>
                <li class="menuitem"><a id="contact" href="contact.php">CONTACT</a></li>
            </ul>
    </div>
