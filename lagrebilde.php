<?php

    extract($_POST);
    
    $target_dir = "images/".$kategori."/";
    $target_file = $target_dir . basename($_FILES["bilde"]["name"]);
    
    $filename = $_FILES["bilde"]["name"];
    
    $uploadOk = true;
    
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = false;
    }
    
    if ($uploadOk){
        if (move_uploaded_file($_FILES["bilde"]["tmp_name"], $target_file)) {
            echo "Filen ". basename( $_FILES["bilde"]["name"]). " ble vellykket lastet opp!";
        } else {
            echo "Beklager, noe gikk galt...";
        }
    }
    
    //nå er bilde lastet opp, lagre informasjonen i json
    
    
    $json = json_decode(file_get_contents("model/paintings.json"));
    
    $newJsonElement = [$filename, $navn, $beskrivelse];   
    
    array_push($json->$kategori, $newJsonElement);
    
    file_put_contents("model/paintings.json", json_encode($json));
    
?>