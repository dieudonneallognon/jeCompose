<?php
session_start();
require_once('../db-config.php');

$_SESSION['err'] = 1;

//On se connecte à MySQL
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

// 

$unique = true;

$rep = $bdd->query('SELECT * FROM etudiant');

while ($donnes = $rep->fetch()) {
    if ($_POST['matricule'] == $donnes['matricule']) {
        $unique = false;
    }
}

if ($unique) {
    $req = $bdd->prepare('INSERT INTO etudiant (matricule, nom, prenom, mot_de_passe) VALUES(?, ?, ?, ? )');
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



    for ($i =1; $i <= 10; $i++) {
        $req =  $bdd->prepare(
            'INSERT INTO corriger (vraie_rep, id_mat, id_question) VALUES (?, ?, ?)'
        );
        $req->execute([
                "c",
                'edu'.$_POST['matricule'],
                $i
            ]);
    }

    // $req->execute();

    header('Location: ../valide.html');
} else {
    $_SESSION['err_ins'] = 1;
    header('Location: ../inscription.php');
}
