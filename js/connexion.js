$(function() {
	
/*-------------------------------------------- Effet de la page active dans le navigateur -----------------------------------------------------*/
	
	$('ul.nav li:nth-child(3)').addClass('active');
	$('div.navigateur p a[href="connexion.php"]').addClass('actif');
	
	$("form").on("submit", function() {
		
/*-------------------------------------------- Vérification sur le matricule -----------------------------------------------------*/
		
		var regex = /^[0-9]+$/
		
							/*Le matricule est vide*/
		if ($("input#matricule").val() == "") {
			$("div.matricule").addClass("has-error");
			$("div.alert-matricule").addClass("alert-danger");
			$("input#matricule").focus();
			$(".alert-matricule span").html('Inserez votre matricule !');
			$(".alert-matricule").show("slow").delay(2000).hide("slow");
			return false;
		}
		
							/*Le matricule ne commence pas par une lettre majuscule*/
		if (!regex.test($("input#matricule").val())) {
			$("div.matricule").addClass("has-error");
			$("div.alert-matricule").addClass("alert-danger");
			$("input#matricule").focus();
			$(".alert-matricule span").html('Votre matricule contient des caractères incorrects !');
			$(".alert-matricule").show("slow").delay(2000).hide("slow");
			return false;
		}				   /*Le matricule contient moins de 5 caractères*/
		else if ($("input#matricule").val().length < 5) {
			$("div.matricule").addClass("has-error");
			$("div.alert-matricule").addClass("alert-danger");
			$("input#matricule").focus();
			$(".alert-matricule span").html('Votre matricule doit contenir au moins 5 caractères !');
			$(".alert-matricule").show("slow").delay(2000).hide("slow");
			return false;
		}
		else {			  /*Le matricule est correct*/
			$("div.matricule").addClass("has-success").removeClass("has-error");
			$("div.alert-matricule").addClass("alert-success").removeClass("alert-danger");
			$(".alert-matricule span").html('Matricule correct !');
			$(".alert-matricule").show("slow").delay(1000).hide("slow");
		}
		
		
/*-------------------------------------------- Vérification sur le mot de passe -----------------------------------------------------*/
		
							/*Le mot de passe est vide*/
		if ($("input#mdp").val() == "") {
			$("div.mdp").addClass("has-error");
			$("div.alert-mdp").addClass("alert-danger");
			$("input#mdp").focus();
			$(".alert-mdp span").html('Inserez votre mot de passe !');
			$(".alert-mdp").show("slow").delay(2000).hide("slow");
			return false;
		}				   /*Le mot de passe contient moins de 5 caractères*/
		else if ($("input#mdp").val().length < 5) {
			$("div.mdp").addClass("has-error");
			$("div.alert-mdp").addClass("alert-danger");
			$("input#mdp").focus();
			$(".alert-mdp span").html('Votre mot de passe doit contenir au moins 5 caractères !');
			$(".alert-mdp").show("slow").delay(2000).hide("slow");
			return false;
		}
		else {			  /*Le mot de passe est correct*/
			$("div.mdp").addClass("has-success").removeClass("has-error");
			$("div.alert-mdp").addClass("alert-success").removeClass("alert-danger");
			$(".alert-mdp span").html('Mot de passe correct !');
			$(".alert-mdp").show("slow").delay(1000).hide("slow");
		}
	});
});

