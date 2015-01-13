<?php
    if (isset($_GET["page"])){
        $page = $_GET["page"];
    }
    else{
        $page = "home";
    }
    
    
?>

<html>
<head>
    <title>Hilde Morris Equestrial Artist</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css"> </link>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    
    <script type="text/javascript">
        
        $(document).ready(function(){

            var page = <? echo '"'.$_GET['page'].'"'; ?>;
            var currentMenuItem = document.getElementById(page);
           
            if ((page == "horses") || (page == "dogs")) {
                currentMenuItem = document.getElementById("gallery");
            }
           
           $(currentMenuItem).css("font-weight", "bold");

        });
        
    </script>
    
    </head>

<body>  
    <div id="banner">

        <h1>
            HILDE MORRIS HORSE & DOG PORTRAITURE
        </h1>

    
            <ul id="menu">
                <li><a id="home" href="index.php?page=home">HOME</a> |</li> 
                <li><a id="gallery" href="index.php?page=gallery">GALLERY</a> | 
                    <ul id="popup">
                        <li><a href="index.php?page=horses">HORSES</a></li>
                        <li><a href="index.php?page=dogs">DOGS</a></li>
                    </ul>
                </li>
                <li><a id="howdoesitwork" href="index.php?page=howdoesitwork">HOW DOES IT WORK?</a> |</li>
                <li><a id="about" href="index.php?page=about">ABOUT THE ARTIST</a> |</li>
                <li><a id="contact" href="index.php?page=contact">CONTACT</a></li>
            </ul>
        
    
    </div>
    
    </div>
        
    <div id="content">
       <?php
            include($page.".php");
       ?>
    </div>
    
    
    <!--<div id="footer">
        &copy Duff Development 2015. All rights reserved.
    </div>
-->

</body>
</html>
