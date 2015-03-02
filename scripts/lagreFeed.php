<?php

/* Skript som tar imot en ny newsfeed (tittel, tekst, bilde, bildetekst) og 
 *       -lagrer bildet i images/feed/...
 *       -lagrer item i model/feed.json
 */
    
    require("filehandler.php");
    
    print_r($_POST);
    print_r($_FILES);

    $tittel = $_POST["tittel"];
    $tekst = $_POST["tekst"];
    $bilde = $POST["bilde"];
    
    $target_dir = "../images/feed/";
    $numImInDir = count(scandir($target_dir))-1;
    $target_filename = $target_dir.$numImInDir.".jpg";
    
    saveImage($_FILES, $target_filename);
    
    //SÅ LAGRE tittel og tekst (og dato) i ../model/feed.json 
    
?>