<?php
	session_start(); require_once('db-config.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Connexion</title>
		<?php include("includes/head.html"); ?>
		<link rel="stylesheet" type="text/css" href="css/connexion.css">
	</head>

	<body>
		<div class="container-fluid">


			<?php include("includes/navbar-home.html"); ?>

			<div class="row">
				<form class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well form-horizontal" method="post" action="traitement_connexion.php">
					<legend class="text-center">Se Connecter</legend>
					<div class="row">
						<div class="alert alert-block alert-erreur text-center">
							<span></span>
						</div>

						<div class="form-group text-center matricule">
							<label for="matricule" class="col-sm-3 control-label">Matricule:</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="matricule" id="matricule">
								<div class="alert alert-block alert-matricule">
									<span></span>
								</div>
							</div>
						</div>
						<div class="form-group text-center mdp">
							<label for="mdp" class="col-sm-3 control-label">Mot de passe:</label>
							<div class="col-sm-9">
								<input class="form-control" type="password" name="mdp" id="mdp">
								<div class="alert alert-block alert-mdp">
									<span></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<button class="btn btn-primary col-xs-offset-5">
							<span class="glyphicon glyphicon-ok-sign"></span>  Connexion
						</button>
					</div>
				</form>
			</div>

			<?php include("includes/footer.html"); ?>

		</div>

		<script src="js/connexion.js"></script>

<?php

	if (isset($_SESSION['err_co']) && $_SESSION['err_co'] == 1) {
		echo '<script>
				$(function (){
					$("div.alert-erreur").addClass("alert-danger");
					$(".alert-erreur span").html("Matricule ou Mot de passe incorrect !").css("font-weight", "bolder");
					$(".alert-erreur").show("slow").delay(2000).hide("slow");
				});
			</script>';

		unset($_SESSION['err_co']);
	}
?>
	</body>
</html>
