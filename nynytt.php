<?php
    session_start();
    if ($_SESSION["loggedin"] !== "true") {
        header("Location: http://hildemorris.com/login.php");
    }

    // form data comes as string in $news variable
    extract($_POST);
    
    $news_file_name = "siste_nytt.txt";
    $news_file = fopen($news_file_name, "w");
    fwrite($news_file, $news);
    fclose($news_file);
    header("Location: http://hildemorris.com/lastopp.php");
?>
