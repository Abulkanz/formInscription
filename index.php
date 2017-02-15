<?php
session_start();
if (!isset($_SESSION['login'])) {
    Header('Location: authentification.php');
}

echo 'Bonjour ' . $_SESSION['prenom'] . ' ' . $_SESSION['nom'];

var_dump($_SESSION);

if (isset($_POST['deconnexion'])) {
    deconnexion();
}

function deconnexion() {
    $_SESSION = array();
    session_destroy();
    require_once 'index.php';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="index.php">
            <input type="submit" name="deconnexion" value="Se déconnecter">
        </form>


    </body>
</html>
