<?php
	session_start(); require_once('traitements/db-config.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gérer mes matières</title>
		<?php include("includes/head.html"); ?>
		<link rel="stylesheet" type="text/css" href="css/gerer_matieres.css">
	</head>

	<body>
		<div class="container-fluid">
			
			<?php include("includes/navbar-user.html"); ?>

			<div class="row">
				<section class="col-sm-6 col-sm-offset-3">
					<form method="post" action="traitements/traitement_gerer_matieres.php">
						<article class="panel panel-success">
							<div class="panel-heading">
								<h3 class="panel-title text-center">Composer</h3>
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Matieres</th>
												<th>Dates de Compositions</th>
												<th>Ajouter</th>
											</tr>
										</thead>
										<tbody>
									<?php
										
										try
										{
										   $bdd = new PDO($_ENV['DB_SYS'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
										}

										catch(Exception $e)
										{
											// En cas d'erreur, on affiche un message et on arrête tout
											die('Erreur : '.$e->getMessage());
										}
											
										$req = $bdd->query('SET NAMES "utf8"');
											
										$reponse = $bdd->query('SELECT * FROM matieres WHERE id_mat NOT IN (SELECT id_mat FROM enregistrer WHERE matricule=' .$_SESSION['matricule']. ') ORDER BY matieres.date_compo ASC, matieres.heure_debut ASC, matieres.heure_fin ASC');
												  
										$jour = date('d');
										$mois = date('m');
										$annee = date('Y');
										$heure = date('H') + 1;
										$minute = date('i');

										$Dateactuelle = $annee.'-'.$mois.'-'.$jour;
										$Dateactuelle = strtotime($Dateactuelle);

										$HeureActuelle = $heure.':'.$minute ;
										$HeureActuelle = strtotime($HeureActuelle);

										$matieresTrouvee = false;

										while ($donnees = $reponse->fetch())
										{
											$heure_fin = strtotime($donnees['heure_fin']);
											$heure_debut = strtotime($donnees['heure_debut']);
											$date_compo = strtotime($donnees['date_compo']);

											if ($Dateactuelle < $date_compo)
											{
												echo '<tr>';
													echo '<td><label for="A-' .$donnees['id_mat']. '">' .$donnees['nom_mat']. '</label></td>';
													echo '<td>' .$donnees['date_compo'].'<br>'. $donnees['heure_debut'].' à '. $donnees['heure_fin'].'</td>';
													echo '<td><input type="checkbox" name="A-' .$donnees['id_mat']. '" id="A-' .$donnees['id_mat']. '" ></td>';
												echo '</tr>';
												$matieresTrouvee = true;
											}
											else if ($Dateactuelle == $date_compo && $HeureActuelle < $heure_fin)
											{
												echo '<tr>';
													echo '<td><label for="A-' .$donnees['id_mat']. '">' .$donnees['nom_mat']. '</label></td>';
													echo '<td>' .$donnees['date_compo'].'<br>'. $donnees['heure_debut'].' à '. $donnees['heure_fin'].'</td>';
													echo '<td><input type="checkbox" name="A-' .$donnees['id_mat']. '" id="A-' .$donnees['id_mat']. '" ></td>';
												echo '</tr>';
												$matieresTrouvee = true;
											}
										}
										if (!$matieresTrouvee)	
										{
											echo '<tr>';
												echo '<td> -- </td>';
												echo '<td> -- </td>';
												echo '<td> -- </td>';
											echo '</tr>';
										}
											
											
										$reponse->closeCursor();
									?>
										</tbody>
									</table>
								</div>
							</div>
						</article>

						<article class="panel panel-danger">
							<div class="panel-heading">
								<h3 class="panel-title text-center">Ne plus composer</h3>
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Matieres</th>
												<th>Dates de Compositions</th>
												<th>Supprimer</th>
											</tr>
										</thead>
										<tbody>
											
									<?php
										
										try
										{
											$bdd = new PDO($_ENV['DB_SYS'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
										}

										catch(Exception $e)
										{
											// En cas d'erreur, on affiche un message et on arrête tout
											die('Erreur : '.$e->getMessage());
										}
											
										$req = $bdd->query('SET NAMES "utf8"');

										$reponse = $bdd->query('SELECT COUNT(matricule) AS Nbr FROM enregistrer WHERE matricule="'.$_SESSION['matricule'].'"');
										
										$donnees = $reponse->fetch();
										$reponse->closeCursor();

										$matieresTrouvee = false;
											
										if ($donnees['Nbr'] > 0)
										{
											$reponse = $bdd->query('SELECT * FROM enregistrer INNER JOIN  matieres ON enregistrer.id_mat = matieres.id_mat WHERE matricule=' .$_SESSION['matricule']. ' ORDER BY matieres.date_compo ASC, matieres.heure_debut ASC, matieres.heure_fin ASC');

											$jour = date('d');
											$mois = date('m');
											$annee = date('Y');
											$heure = date('H') + 1;
											$minute = date('i');

											$Dateactuelle = $annee.'-'.$mois.'-'.$jour;
											$Dateactuelle = strtotime($Dateactuelle);

											$HeureActuelle = $heure.':'.$minute ;
											$HeureActuelle = strtotime($HeureActuelle);

											while ($donnees = $reponse->fetch())
											{
												$heure_fin = strtotime($donnees['heure_fin']);
												$heure_debut = strtotime($donnees['heure_debut']);
												$date_compo = strtotime($donnees['date_compo']);

												if ($Dateactuelle < $date_compo)
												{
													echo '<tr>';
														echo '<td><label for="S-' .$donnees['id_mat']. '">' .$donnees['nom_mat']. '</label></td>';
														echo '<td>' .$donnees['date_compo'].'<br>'. $donnees['heure_debut'].' à '. $donnees['heure_fin'].'</td>';
														echo '<td><input type="checkbox" name="S-' .$donnees['id_mat']. '" id="S-' .$donnees['id_mat']. '" ></td>';
													echo '</tr>';
													$matieresTrouvee = true;
												}
												else if ($Dateactuelle == $date_compo && $HeureActuelle < $heure_debut)
												{
													echo '<tr>';
														echo '<td><label for="S-' .$donnees['id_mat']. '">' .$donnees['nom_mat']. '</label></td>';
														echo '<td>' .$donnees['date_compo'].'<br>'. $donnees['heure_debut'].' à '. $donnees['heure_fin'].'</td>';
														echo '<td><input type="checkbox" name="S-' .$donnees['id_mat']. '" id="S-' .$donnees['id_mat']. '" ></td>';
													echo '</tr>';
													$matieresTrouvee = true;
												}
											}
											$reponse->closeCursor();
										}
										if (!$matieresTrouvee)
										{
											echo '<tr>';
												echo '<td> -- </td>';
												echo '<td> -- </td>';
												echo '<td> -- </td>';
											echo '</tr>';
										}
											
										$reponse->closeCursor();
									?>
										</tbody>
									</table>
								</div>
							</div>
						</article>
						<div class="row">
							<div class="col-sm-4 col-sm-offset-4 hidden-xs">
								<input type="submit" class="btn btn-primary" value="Appliquer les modifications" disabled="disabled">
							</div>
							<div class="col-sm-4 col-sm-offset-4 visible-xs">
								<input type="submit" class="btn btn-primary btn-block" value="Appliquer les modifications" disabled="disabled">
							</div>
						</div>
					</form>
				</section>
			</div>

			<?php include("includes/footer.html"); ?>
			
		</div>
		
		<script src="js/gerer_matieres.js"></script>
	</body>
</html>
