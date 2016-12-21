<?php

    if (isset($_POST["send"])){

        //$mailinglist = json_decode(file_get_contents("mailinglist.json"));
    
        $mailinglist = ["gudbrandduff@gmail.com"];
        
        $tittel = $_POST["tittel"];
        $subject = 'New blog-post from Sarah and Gudbrand - '.$tittel;
        $headers = "From: Gudbrand & Sarah\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html;' . "\r\n";

        foreach ($mailinglist as $mail){
            $message = "Check it out at gudbrandogsarah.no! \n\n Or <a href='http://www.gudbrandogsarah.no/scripts/unsubscribe.php?mail=".$mail."'>Unsubscribe..</a>";
            $sendt = mail($mail, $subject, $message, $headers);
            
            if ($sendt) {
                echo "sendt mail til ".$mail."<br>";
            } else {
                print_r(error_get_last());
            }
            
        }

    }
?>

<form method="post">
    <input type="text" name="tittel">
    <input type="submit" value="send" name="send">
</form>