<?php

	session_start(); require_once('db-config.php');

	try
	{	// On se connecte à MySQL
		$bdd = new PDO($_ENV['DB_SYS'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
	}

	catch(Exception $e)
	{
		// En cas d'erreur, on affiche un message et on arrête tout
		die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->query('SET NAMES "utf8"');


	$mdp_hache = sha1($_POST['mdp']);

	$req = $bdd->prepare('SELECT matricule FROM etudiant WHERE matricule = ? AND mot_de_passe = ?');

	$req->execute(array(
		$_POST['matricule'],
		$_POST['mdp']));

	$resultat = $req->fetch();

	if (!$resultat)
	{
		$_SESSION['err_co'] = 1;
		header('Location: ../connexion.php');
	}
	else
	{
		$_SESSION['matricule'] = $_POST['matricule'];
		$_SESSION['motDePasse'] = $_POST['mdp'];

		$req = $bdd->prepare('INSERT INTO matieres (id_mat, date_compo, heure_debut, nom_mat, heure_fin) VALUES (?, ?, ?, ?, ?)');

	$req->execute(array(
		'edu'.$_POST['matricule'],
		date('Y-m-d'),
		date('H:i:s'),
		'MAtière de Test',
		date('H:i:s', strtotime('+ 600 seconds'))));

		header('Location: ../matieres.php');
	}
?>
