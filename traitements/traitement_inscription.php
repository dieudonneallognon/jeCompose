<?php
session_start();
require_once('db-config.php');

$_SESSION['err'] = 1;

// // On se connecte à MySQL
// try {
//     $bdd = new PDO(
//         $_ENV['DB_SYS'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'],
//         $_ENV['DB_USERNAME'],
//         $_ENV['DB_PASSWORD']
//     );
// } catch (Exception $e) {
//     // En cas d'erreur, on affiche un message et on arrête tout
//     die('Erreur : '.$e->getMessage());
// }

// $req = $bdd->query('SET NAMES "utf8"');

$unique = true;

// $rep = $bdd->query('SELECT * FROM etudiant');

// while ($donnes = $rep->fetch()) {
//     if ($_POST['matricule'] == $donnes['matricule']) {
//         $unique = false;
//     }
// }

if ($unique) {
    /* $req = $bdd->prepare('INSERT INTO etudiant (matricule, nom, prenom, mot_de_passe) VALUES(?, ?, ?, ? )');
     $req->execute(array( $_POST['matricule'], $_POST['nom'], $_POST['prenom'], $_POST['mdp'] ));

     $_SESSION['matricule'] = $_POST['matricule'];
     $_SESSION['motDePasse'] = $_POST['mdp'];

     $req = $bdd->prepare(
         'INSERT INTO matieres (id_mat, date_compo, heure_debut, nom_mat, heure_fin)
         VALUES (?, ?, ?, ?, ?)'
     );

     $req->execute(array(
     'edu'.$_POST['matricule'],
     date('Y-m-d'),
     date('H:i:s', strtotime('+ 1 hour')),
     'MAtière de Test',
     date('H:i:s', strtotime('+ 1 hour 600 seconds'))));

     $req = $bdd->prepare(
         'INSERT INTO corriger (vraie_rep, id_mat, id_question) VALUES
         ("b", edu'.$_POST['matricule'].', 1),
         ("c", edu'.$_POST['matricule'].', 2),
         ("c", edu'.$_POST['matricule'].', 3),
         ("c", edu'.$_POST['matricule'].', 4),
         ("b", edu'.$_POST['matricule'].', 5),
         ("b", edu'.$_POST['matricule'].', 6),
         ("b", edu'.$_POST['matricule'].', 7),
         ("a", edu'.$_POST['matricule'].', 8),
         ("9", edu'.$_POST['matricule'].', 9),
         ("10", edu'.$_POST['matricule'].', 10)'
     );

     $req->execute();*/


    header('Location: ../valide.html');
} else {
    $_SESSION['err_ins'] = 1;
    header('Location: ../inscription.php');
}
