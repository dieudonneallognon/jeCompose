<?php
session_start();
require_once('../db-config.php');

try {    // On se connecte à MySQL
    $bdd = new PDO($_ENV['DB_SYS'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}



$rep = $bdd->prepare('SELECT heure_fin FROM matieres WHERE id_mat=?');
$rep->execute(array($_SESSION['id_mat']));

$d= $rep->fetch();

$heureFin=$d['heure_fin'];
$heureFin=strtotime($heureFin);

$heure = date('H') + 1;
$minute = date('i');

$HeureActuelle = $heure.':'.$minute ;
$HeureActuelle = strtotime($HeureActuelle);


if ($HeureActuelle > $heureFin) {
    $_SESSION['err_qcm'] = 1;
    header('Location: ../matieres.php');
} else {
    $fichier = fopen('../fichiers_composition/'.$_SESSION['matricule'].'-'.$_SESSION['id_mat'].'.txt', 'w');

    fputs($fichier, 'Résultat '.$_SESSION['nm_mat'].'');

    fputs($fichier, 'Choix -- Correction');

    $rep = $bdd->prepare('SELECT vraie_rep FROM corriger WHERE id_mat=? ORDER BY id_question');
    $rep->execute(array($_SESSION['id_mat']));

    $req1 = $bdd->prepare('INSERT INTO repondre (matricule, id_mat, id_question, rep_etu) VALUES(?, ?, ?, ? )');

    $req2 = $bdd->prepare('UPDATE enregistrer SET note=:note WHERE matricule=:matricule AND id_mat=:id_mat');
    $note = 0;

    for ($i = 1; $donnees = $rep->fetch(); $i++) {
        if (isset($_POST['q'.$i])) {
            $req1->execute(array($_SESSION['matricule'], $_SESSION['id_mat'], $i, $_POST['q'.$i]));

            fputs($fichier, $i.'. '.$_POST['q'.$i].' -- '.$donnees['vraie_rep'].'');

            if ($_POST['q'.$i] == $donnees['vraie_rep']) {
                $note+=2;
            }
        } else {
            $req1->execute(array($_SESSION['matricule'], $_SESSION['id_mat'], $i, null));

            fputs($fichier, $i.'. rien -- '.$donnees['vraie_rep'].'');
        }
    }

    $req2->execute(array(
        'note'=>$note,
        'matricule'=>$_SESSION['matricule'],
        'id_mat'=>$_SESSION['id_mat'])) or die(print_r($bdd->errorInfo()));

    $rep->closeCursor();
    $req1->closeCursor();
    $req2->closeCursor();

    fputs($fichier, 'Note: '.$note.'/20');

    if ($note >= 18 && $note <= 20) {
        fputs($fichier, 'Mention: Excellente');
    } elseif ($note >= 16 && $note <= 17) {
        fputs($fichier, 'Mention: Très Bien');
    } elseif ($note >= 14 && $note <= 15) {
        fputs($fichier, 'Mention: Bien');
    } elseif ($note >= 12 && $note <= 13) {
        fputs($fichier, 'Mention: Assez Bien');
    } elseif ($note >= 10 && $note <= 11) {
        fputs($fichier, 'Mention: Passable');
    } elseif ($note >= 8 && $note <= 9) {
        fputs($fichier, 'Mention: Inssufisant');
    } elseif ($note >= 0 && $note <= 7) {
        fputs($fichier, 'Mention: Très Inssufisant');
    }

    fclose($fichier);

    unset($_SESSION['id_mat']);
    unset($_SESSION['nm_mat']);


    header('Location: ../matieres.php');
}