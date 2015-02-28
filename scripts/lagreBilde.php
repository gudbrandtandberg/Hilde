<?php
    /* Skript som blir servert et bilde med metadata (kategori og tekst)
    fra nyttBilde.php og så
    
            -komprimerer det
            -lagrer det i images
            -oppdaterer model/paintings.json
    
    */

    print_r($_POST);
    print_r($_FILES);
    
    $category = $_POST["category"];
    $target_dir = "/Users/gudbrand/Documents/html/Hilde/images/".$category."/";
    $target_file = $target_dir.basename($_FILES["bildefil"]["name"]);
    $uploadOk = 0;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["bildefil"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    
        //DETTE FUNKER IKKE HELT AV EN ELLER ANNEN GRUNN...
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["bildefil"]["tmp_name"], $target_file)) {
                echo "fil lastet opp";
            }
            else {
                echo "fiasko";
            }
        }
    }
    
    

?>