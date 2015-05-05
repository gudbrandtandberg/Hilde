<?php

/*
 * saveImage(files, target_filename)
 * lagrer bilde der det bør lagres med det navnet det bør ha
 */

function saveImage($input_file, $target_filename){

    $uploadOk = false;
    $success = false;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($input_file["tmp_name"]);
    if($check == true) {
        //filen er et bilde
        $uploadOk = true;
    } else {
        echo "File is not an image.";
    }

    //hvis filen ikke var ok forsøker vi ikke å lagre
    if (!$uploadOk) {
        echo "Sorry, your file was not uploaded. Because it is a bad file!";
    
    } else {
        if (move_uploaded_file($input_file["tmp_name"], $target_filename)) {
            $success = true;
        }
        else {
            echo "Gikk ikke ann å move_uploaded_file()";
        }
    }
    
    return $success;
}
    
?>