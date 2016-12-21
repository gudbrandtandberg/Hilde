<?php
    session_start();
    if ($_SESSION["loggedin"] !== "true") {
        header("Location: http://hildemorris.com/login.php");
    }

    // form data comes in form of string delimited by a semicolon, category before, filename after, then index in json category
    extract($_POST);
    $delete_arr = explode(";", $delete_pic);
    $category = $delete_arr[0];
    $filename = $delete_arr[1];
    $json_i = intval($delete_arr[2]);
    $delete_dir = "images/" . $category . "/";
    $delete_file = $delete_dir . $filename;

    // sletter filen
    unlink($delete_file);

    // fjerner filen fra json
    $json = json_decode(file_get_contents("model/paintings.json"));
    $category_arr = $json->$category;
    unset($category_arr[$json_i]);
    $json->$category = $category_arr;
    file_put_contents("model/paintings.json", json_encode($json));
    header("Location: http://hildemorris.com/lastopp.php");
?>

