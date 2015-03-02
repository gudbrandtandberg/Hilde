<?php

/*
 * saveImage(files, target_filename)
 * lagrer bilde der det bør lagres med det navnet det bør ha
 */

function saveImage($files, $target_filename){

    $uploadOk = 0;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($files["bildefil"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - ".$check["mime"].".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    //DETTE FUNKER IKKE HELT AV EN ELLER ANNEN GRUNN...
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded. Because it is a bad file!";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($files["bildefil"]["tmp_name"], $target_filename)) {
            echo "fil lastet opp";
        }
        else {
            echo "fiasko";
        }
    }
    
    return $uploadOk;
}
    
?>