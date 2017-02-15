<?php

require_once 'include/connexion.php';
require_once 'include/infoConnexion.php';
require_once 'include/executeRequete.php';

$cnx = connexion(SERVEUR, UTILISATEUR, MOTDEPASSE, BASEDEDONNEES);
$msg = "Michto <br>";
$varQuery = "CREATE TABLE utilisateurs(
                prenom varchar(25) NOT NULL,
                nom varchar(40) NOT NULL,
                login varchar(255) NOT NULL UNIQUE,
                motDePasse varchar(255) NOT NULL)
                CHARSET UTF8 ENGINE=InnoDB";
$idRequete = executeR($cnx, $varQuery);

//Complexification du mdp
$droite = "tk!@";
$gauche = "ar3o&b%";

//Ajout des utilisateurs
$prenom = "Agathe";
$nom = "Zepoweur";
$login = "aZepoweur";
$mdp = "123456";
$jeton = hash('ripemd128',
         "$gauche.$mdp.$droite");
         
ajouterUtilisateur($cnx, $prenom, $nom, $login, $jeton, $msg);
echo "<p>$msg</p>";

$prenom = "Kimberley";
$nom = "Tartine";
$login = "kTartine";
$mdp = "654321";
$jeton = hash('ripemd128',
         "$gauche.$mdp.$droite");

ajouterUtilisateur($cnx, $prenom, $nom, $login, $jeton, $msg);
echo "<p>$msg</p>";

function ajouterUtilisateur($cnx, $prenom, $nom, $login, $jeton, &$msg){
    $sql="INSERT INTO utilisateurs VALUES('$nom', '$prenom', '$login', '$jeton')";
    $idRequete = executeR($cnx, $sql);
    $msg = $msg.sprintf("L'utilisateur %s %s a été créé avec succès. <br>", $prenom, $nom);
}
 


