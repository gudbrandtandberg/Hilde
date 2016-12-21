<?php
    if (!isset($_SESSION)) session_start();

    if ($_SESSION["lang"] == "en"){
        $_SESSION["lang"] = "no";
    } else {
        $_SESSION["lang"] = "en";
    }

    $lang = $_SESSION["lang"];
    include($lang.".strings.php");
    
    echo "Skifter språk til ".$_SESSION["lang"];

?>