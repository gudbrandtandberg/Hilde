<?php

/* Skript som blir servert et bilde med metadata (kategori og tekst)
 * fra nyttbilde.php i en ajax-request og så:    
 *       -lagrer det i images/...
 *       -oppdaterer model/paintings.json
 *       -sender noe i retur? Kanskje bare echo "success!";
 */

    require("filehandler.php");
    ini_set("display_errors", 0);
    
    $bildefil = $_FILES["bildefil"];
    sleep(3);
    
    //henter form-data
    $category = $_GET["kategori"];
    $tekst = $_GET["bildetekst"];
    
    //forbereder target filnavn
    $target_dir = "../images/".$category."/";
    $numImInDir = count(scandir($target_dir))-2;
    $target_filename = $target_dir.$numImInDir.".jpg"; 
    
    //OG SÅ OPPDATERE JSON, DVS. PAINTINGS.JSON MÅ FÅ ET NYTT ELEMENT MED TEKSTEN (KANSKJE BARE DET?)
    
    
    //prøve å lagre bildet
    if  (saveImage($bildefil, $target_filename)){
        echo "YES";
    }
    
?>