<?php

/* Skript som blir servert et bilde med metadata (kategori og tekst)
 * fra nyttbilde.php i en ajax-request og så:    
 *       -lagrer det i images/...
 *       -oppdaterer model/paintings.json
 *       -sender noe i retur? Kanskje bare echo "success!";
 */

    require("filehandler.php");
    
    print_r($_POST);
    echo "\n";
    print_r($_FILES);
    
    $category = $_POST["kategori"];
    
    $target_dir = "/Users/gudbrand/Documents/html/Hilde/images/".$category."/";
    $numImInDir = count(scandir($target_dir))-2;
    $target_filename = $target_dir.$numImInDir.".jpg"; //HER MÅ MAN GENERERE NAVN BASERT PÅ ANTALL BILDER
    
    //saveImage($_FILES, $target_filename);
    
    //OG SÅ OPPDATERE JSON, DVS. PAINTINGS.JSON MÅ FÅ ET NYTT ELEMENT MED TEKSTEN (KANSKJE BARE DET?)

?>