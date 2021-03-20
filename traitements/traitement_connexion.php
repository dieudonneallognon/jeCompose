<?php

session_start();
require_once('../db-config.php');

// On se connecte à MySQL
try {
    $bdd = new PDO(
        $_ENV['DB_SYS'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD']
    );
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}




$mdp_hache = sha1($_POST['mdp']);

$req = $bdd->prepare('SELECT matricule FROM etudiant WHERE matricule = ? AND mot_de_passe = ?');

$req->execute(array(
    $_POST['matricule'],
    $_POST['mdp']));

$resultat = $req->fetch();

if (!$resultat) {
    $_SESSION['err_co'] = 1;
    header('Location: ../connexion.php');
} else {
    $_SESSION['matricule'] = $_POST['matricule'];
    $_SESSION['motDePasse'] = $_POST['mdp'];

    header('Location: ../matieres.php');
}
