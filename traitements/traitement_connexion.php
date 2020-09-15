<?php

	session_start();

	try
	{	// On se connecte à MySQL
		$bdd = new PDO('mysql:host=localhost;dbname=jecompose', 'root', '');
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
		header('Location: ../matieres.php');
	}
?>