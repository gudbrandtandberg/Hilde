<html>
<head>
    <title>Hilde Morris Equestrian Artist</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css"> </link>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    
    <script type="text/javascript">
        
        $(document).ready(function(){ 
	    var currentMenuItem = "home";
            $(currentMenuItem).css("font-weight", "bold");
           
            $('#menu .enlinje').each(function(){
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
                <li class="enlinje"><a id="home" href="index.php">HOME</a></li>
                <li class="strek">|</li>
                <li class="enlinje"><a id="gallery" href="gallery.php">GALLERY</a> 
                    <ul id="popup">
                        <li class="popupitem"><a href="horses.php">HORSES</a></li>
                        <li class="popupitem"><a href="dogs.php">DOGS</a></li>
                    </ul>
                </li>
                <li class="strek">|</li>
                <li class="enlinje"><a id="howdoesitwork" href="howdoesitwork.php">THE PROCESS</a></li>
                <li class="strek">|</li>
                <li class="enlinje"><a id="about" href="about.php">ABOUT THE ARTIST</a></li>
                <li class="strek">|</li>
                <li class="enlinje"><a id="contact" href="contact.php">CONTACT</a></li>
            </ul>
    </div>
