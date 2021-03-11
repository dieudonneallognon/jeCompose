<?php
    session_start(); require_once('db-config.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Inscription</title>
		<?php include("includes/head.html"); ?>
		<link rel="stylesheet" type="text/css" href="css/inscription.css">
	</head>

	<body>
		<div class="container-fluid">

			<?php include("includes/navbar-home.html"); ?>

			<div class="row">
				<form class="col-sm-6 col-sm-offset-3 well form-horizontal" method="post" action="traitements/traitement_inscription.php">
					<legend class="text-center">Inscription</legend>
						<div class="row">
							<div class="form-group text-center nom">
								<label for="nom" class="col-sm-2 control-label">Nom:</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" name="nom" id="nom">
									<div class="alert alert-block alert-nom">
										<span></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group text-center prenom">
								<label for="prenom" class="col-sm-2 control-label">Prenoms:</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" name="prenom" id="prenom">
									<div class="alert alert-block alert-prenom">
										<span></span>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group text-center matricule-mdp">
								<div class="matricule">
									<label for="matricule" class="col-sm-2 control-label matricule">Matricule:</label>
									<div class="col-sm-4">
										<input class="form-control" type="text" name="matricule" id="matricule">
										<div class="alert alert-block alert-matricule">
											<span></span>
										</div>
									</div>
								</div>
								<div class="mdp">
									<label for="mdp" class="col-sm-2 control-label">Mot de passe:</label>
									<div class="col-sm-4">
										<input class="form-control" type="password" name="mdp" id="mdp">
										<div class="alert alert-block alert-mdp"
									   >
											<span></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<button class="btn btn-success col-xs-offset-5">
								<span class="glyphicon glyphicon-ok-sign"></span>  S'inscrire
							</button>
						</div>
					</form>
				</div>

			<?php include("includes/footer.html"); ?>

		</div>

		<script src="js/inscription.js"></script>
<?php
    if (isset($_SESSION['err_ins']) && $_SESSION['err_ins'] == 1) {
        echo '<script>
				$(function (){
					$("div.matricule-mdp div.matricule").addClass("has-error");
					$("div.alert-matricule").addClass("alert-danger");
					$(".alert-matricule span").html("Ce matricule existe déjà !").css("font-weight", "bolder");;
					$(".alert-matricule").show("slow").delay(2000).hide("slow");
				});
			</script>';

        unset($_SESSION['err_ins']);
    }
?>
	</body>
</html>
