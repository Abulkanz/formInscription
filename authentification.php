<?php
session_start();

require_once 'include/connexion.php';
require_once 'include/infoConnexion.php';
require_once 'include/executeRequete.php';

$cnx = connexion(SERVEUR, UTILISATEUR, MOTDEPASSE, BASEDEDONNEES);

if (isset($_POST['valider'])) {

    $tmp_login = $_POST['fLogin'];
    $tmp_mdp = $_POST['fMdp'];

    $sql = "SELECT * FROM utilisateurs WHERE login='$tmp_login'";
    $idRequete = executeR($cnx, $sql);

    if ($idRequete->rowCount() == 1) {
        $row = $idRequete->fetch(PDO::FETCH_NUM);
        $droite = "tk!@";
        $gauche = "ar3o&b%";
        $jeton = hash('ripemd128', "$gauche.$tmp_mdp.$droite");
        echo 'Ketchoze';
        if ($jeton == $row[3]) {
            session_start();
            $_SESSION['login'] = $tmp_login;
            $_SESSION['nom'] = $row[1];
            $_SESSION['prenom'] = $row[0];
            Header('Location: index.php');
        } else {
            echo "Mot de passe inconnu";
        }
    } else {
        echo "Nom inconnu";
    }
}

if (isset($_POST['inscription'])) {

    if (isset($_SESSION['login'])) {
        $_SESSION = array();
        session_destroy();
        require_once 'index.php';
    } else {
        Header('Location: inscription.php');
    }
}
?>

<form method="POST" action="authentification.php">
    <input type="text" name="fLogin" placeholder="Lauguine">
    <input type="password" name="fMdp" placeholder="Maudepace">
    <input type="submit" name="valider" value="Confirmer">
</form>

<form method="POST" action="authentification.php">
    <label for="register">S'incrire</label>
    <input id="register" type="submit" name="inscription" value="Go">
</form>