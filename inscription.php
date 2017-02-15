<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
    </head>
    <body>
        <form method="POST" action="inscription.php">
            <label for="iNom">Nom</label>
            <br>
            <input id="iNom" type='text' name="nom">
            <br>
            <label for="iPrenom">Prénom</label>
            <br>
            <input id="iPrenom" type='text' name="prenom">
            <br>
            <label for="iLogin">Login</label>
            <br>
            <input id="iLogin" type='text' name="login" onblur="verifUser(this)"><span id="info"></span>
            <br>
            <label for="iMdp">Mot de passe</label>
            <br>
            <input id="iMdp" type='password' name="password">
            <br>
            <input type='submit' name="vInscr" value="Valider">
        </form>
        <script src="js/validation.js" type="text/javascript"></script>
    </body>
</html>
<?php
require_once 'include/connexion.php';
require_once 'include/infoConnexion.php';
require_once 'include/executeRequete.php';



if (isset($_POST['vInscr'])) {
    $cnx = connexion(SERVEUR, UTILISATEUR, MOTDEPASSE, BASEDEDONNEES);
    $msg = "Super <br>";
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $login = $_POST['login'];
    $mdp = $_POST['password'];

    $droite = "tk!@";
    $gauche = "ar3o&b%";
    $jeton = hash('ripemd128', "$gauche.$mdp.$droite");

    ajouterUtilisateur($cnx, $prenom, $nom, $login, $jeton, $msg);
}

function ajouterUtilisateur($cnx, $prenom, $nom, $login, $jeton, &$msg) {
    $sql = "INSERT INTO utilisateurs VALUES('$nom', '$prenom', '$login', '$jeton')";
    $idRequete = executeR($cnx, $sql);
    $msg = $msg . sprintf("L'utilisateur %s %s a été créé avec succès. <br>", $prenom, $nom);
}
