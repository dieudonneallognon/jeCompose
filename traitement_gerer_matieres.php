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

	$reponse = $bdd->query('SELECT id_mat, nom_mat FROM matieres');

	while ($donnees = $reponse->fetch()) {

		if (isset ( $_POST['A-'.$donnees['id_mat']] ) )
		{
			 $req=$bdd->prepare('INSERT INTO enregistrer VALUES (NULL, ?, ?)');
			 $req->execute(array($_SESSION['matricule'], $donnees['id_mat'])) or die(print_r($bdd->errorInfo()));
		}
		else if ( isset( $_POST['S-'.$donnees['id_mat']] ) )
		{
			$req=$bdd->prepare('DELETE FROM enregistrer WHERE id_mat=? AND matricule=?') or die(print_r($bdd->errorInfo()));
			$req->execute( array ( $donnees['id_mat'],$_SESSION['matricule'] ) ) or die(print_r($bdd->errorInfo()));
		}
	}

	$reponse->closeCursor();

	$_SESSION['mat'] = 1;
	header('Location: ../matieres.php');

?>
