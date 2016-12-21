<?php
    session_start();
    if ($_SESSION["loggedin"] !== "true") {
        header("Location: http://hildemorris.com/login.php");
        exit();
    }

    extract($_POST);
    
    $target_dir = "images/".$kategori."/";
    $filename = $_FILES["bilde"]["name"];
    $target_file = $target_dir . basename($filename);
    
    if (file_exists($target_file)) {
        echo "Beklager, noe gikk galt...";
        exit();
    }
    
    move_uploaded_file($_FILES["bilde"]["tmp_name"], $target_file);
    //nå er bilde lastet opp, lagre informasjonen i json
    
    $json = json_decode(file_get_contents("model/paintings.json"));
    
    $newJsonElement = [$filename, $navn, $beskrivelse];   
    
    array_push($json->$kategori, $newJsonElement);
    
    file_put_contents("model/paintings.json", json_encode($json));
    header("Location: http://hildemorris.com/lastopp.php");
?>
