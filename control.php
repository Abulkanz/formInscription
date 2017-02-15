<?php

require_once './include/connexion.php';
require_once './include/infoConnexion.php';
require_once './include/executeRequete.php';

$cnx = connexion(SERVEUR, UTILISATEUR, MOTDEPASSE, BASEDEDONNEES);

if (isset($_POST['login'])) {
    $login = $_POST['login'];
    $sql = 'SELECT login FROM utilisateurs where login = ?';
    $idRequete = executeR($cnx, $sql, array($login));
    if ($idRequete->rowCount() == 1) {
        echo "<span style='color: red;'>&nbsp; &#x2718; Ce login existe déjà</span>";
    } else {
        echo "<span style='color: green;'>&nbsp; &#x2714; Login disponible</span>";
    }
}

