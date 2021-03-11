<?php
    session_start(); require_once('db-config.php');
    //$_SESSION['matricule'];
    //$_SESSION['motDePasse'];
    $_SESSION['err'] = 1;

    try {	// On se connecte à MySQL
        $bdd = new PDO($_ENV['DB_SYS'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    } catch (Exception $e) {
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
    }

    $req = $bdd->query('SET NAMES "utf8"');

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

    header('Location: ../valide.html');
    } else {
        $_SESSION['err_ins'] = 1;
        header('Location: ../inscription.php');
    }
