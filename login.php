<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        extract($_POST);
        $u = $user;
        $p = $password;
        if ($u === "Hilde" && password_verify($p, '$2y$10$W8BiEuV.daNYetHZYlUt2u0i21kVtJutyZOcuIl797iEBaSn2tMf2')) {
            session_start();
            $_SESSION["loggedin"] = "true";
            header("Location: http://hildemorris.com/lastopp.php");
            exit();
        } else {
            echo "Feil brukernavn og passord";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log in</title>
</head>
<body>
<form id="login_form" name="login" action="login.php" method="post">
    <label>Navn:</label>
    <input type="text" name="user"/>
    <label>Passord:</label>
    <input type="password" name="password"/>
    <button type="submit" form="login_form"> Logg inn </button>
</form>
</body>
</html>
