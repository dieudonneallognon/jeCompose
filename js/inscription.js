$(function() {

/*-------------------------------------------- Effet de la page active dans le navigateur -----------------------------------------------------*/

	$('ul.nav li:nth-child(2)').addClass('active');
	$('div.navigateur p a[href="inscription.php"]').addClass('actif');
	
	$("form").on("submit", function() {
		
/*-------------------------------------------- Vérification sur le nom -----------------------------------------------------*/
		
		var regex = /^[A-Za-z \-ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØŒÙÚÛÜÝŸÞßàáâãäåæçèéêëìíîïðñòóôõöøœùúûüýþÿ\.]+$/;
		
							/*Le nom est vide*/
		if ($("input#nom").val() == "") {
			$("div.nom").addClass("has-error");
			$("div.alert-nom").addClass("alert-danger");
			$("input#nom").focus();
			$(".alert-nom span").html('Inserez votre nom !');
			$(".alert-nom").show("slow").delay(2000).hide("slow");
			return false;
		}
		
							/*Le nom contient des caractères incorrects*/
		if (!regex.test($("input#nom").val())) {
			$("div.nom").addClass("has-error");
			$("div.alert-nom").addClass("alert-danger");
			$("input#nom").focus();
			$(".alert-nom span").html('Votre nom contient des caractères incorrects !');
			$(".alert-nom").show("slow").delay(2000).hide("slow");
			return false;
		}
		else {			  /*Le nom est correct*/
			$("div.nom").addClass("has-success").removeClass("has-error");
			$("div.alert-nom").addClass("alert-success").removeClass("alert-danger");
			$(".alert-nom span").html('Nom correct !');
			$(".alert-nom").show("slow").delay(1000).hide("slow");
		}
		
		
/*-------------------------------------------- Vérification sur le prénom -----------------------------------------------------*/
		
		var regex = /^[A-ZÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØŒÙÚÛÜÝŸ]$/
		
							/*Le prénom est vide*/
		if ($("input#prenom").val() == "") {
			$("div.prenom").addClass("has-error");
			$("div.alert-prenom").addClass("alert-danger");
			$("input#prenom").focus();
			$(".alert-prenom span").html('Inserez votre prénom !');
			$(".alert-prenom").show("slow").delay(2000).hide("slow");
			return false;
		}
			
							/*Le prénom ne commence pas par une lettre majuscule*/
		if (!regex.test($("input#prenom").val()[0])) {
			$("div.prenom").addClass("has-error");
			$("div.alert-prenom").addClass("alert-danger");
			$("input#prenom").focus();
			$(".alert-prenom span").html('Votre prénom doit débuter par une lettre majuscule');
			$(".alert-prenom").show("slow").delay(4000).hide("slow");
			return false;
		}
		else if ($("input#prenom").val().length < 3) {
			$("div.prenom").addClass("has-error");
			$("div.alert-prenom").addClass("alert-danger");
			$("input#prenom").focus();
			$(".alert-prenom span").html('Votre prénom doit contenir au moins 3 caractères !');
			$(".alert-prenom").show("slow").delay(2000).hide("slow");
			return false;
		}
		
		var regex = /^[A-Za-z \-ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØŒÙÚÛÜÝŸÞßàáâãäåæçèéêëìíîïðñòóôõöøœùúûüýþÿ\.]+$/;
		
							/*Le prénom contient des caractères incorrects*/
		if (!regex.test($("input#prenom").val())) {
			$("div.prenom").addClass("has-error");
			$("div.alert-prenom").addClass("alert-danger");
			$("input#prenom").focus();
			$(".alert-prenom span").html('Votre prénom contient des caractères incorrects !');
			$(".alert-prenom").show("slow").delay(2000).hide("slow");
			return false;
		}
		else {			  /*Le prénom est correct*/
			$("div.prenom").addClass("has-success").removeClass("has-error");
			$("div.alert-prenom").addClass("alert-success").removeClass("alert-danger");
			$(".alert-prenom span").html('Prénoms corrects !');
			$(".alert-prenom").show("slow").delay(1000).hide("slow");
		}
		
		
/*-------------------------------------------- Vérification sur le matricule -----------------------------------------------------*/
		
		var regex = /^[0-9]+$/
		
							/*Le matricule est vide*/
		if ($("input#matricule").val() == "") {
			$("div.matricule-mdp div.matricule").addClass("has-error");
			$("div.alert-matricule").addClass("alert-danger");
			$("input#matricule").focus();
			$(".alert-matricule span").html('Inserez votre matricule !');
			$(".alert-matricule").show("slow").delay(2000).hide("slow");
			return false;
		}
		
							/*Le matricule ne commence pas par une lettre majuscule*/
		if (!regex.test($("input#matricule").val())) {
			$("div.matricule-mdp div.matricule").addClass("has-error");
			$("div.alert-matricule").addClass("alert-danger");
			$("input#matricule").focus();
			$(".alert-matricule span").html('Votre matricule contient des caractères incorrects !');
			$(".alert-matricule").show("slow").delay(2000).hide("slow");
			return false;
		}				   /*Le matricule contient moins de 5 caractères*/
		else if ($("input#matricule").val().length < 5) {
			$("div.matricule-mdp div.matricule").addClass("has-error");
			$("div.alert-matricule").addClass("alert-danger");
			$("input#matricule").focus();
			$(".alert-matricule span").html('Votre matricule doit contenir au moins 5 caractères !');
			$(".alert-matricule").show("slow").delay(2000).hide("slow");
			return false;
		}
		else {			  /*Le matricule est correct*/
			$("div.matricule-mdp div.matricule").addClass("has-success").removeClass("has-error");
			$("div.alert-matricule").addClass("alert-success").removeClass("alert-danger");
			$(".alert-matricule span").html('Matricule correct !');
			$(".alert-matricule").show("slow").delay(1000).hide("slow");
		}
		
		
/*-------------------------------------------- Vérification sur le mot de passe -----------------------------------------------------*/
		
							/*Le mot de passe est vide*/
		if ($("input#mdp").val() == "") {
			$("div.matricule-mdp div.mdp").addClass("has-error");
			$("div.alert-mdp").addClass("alert-danger");
			$("input#mdp").focus();
			$(".alert-mdp span").html('Inserez votre mot de passe !');
			$(".alert-mdp").show("slow").delay(2000).hide("slow");
			return false;
		}				   /*Le mot de passe contient moins de 5 caractères*/
		else if ($("input#mdp").val().length < 5) {
			$("div.matricule-mdp div.mdp").addClass("has-error");
			$("div.alert-mdp").addClass("alert-danger");
			$("input#mdp").focus();
			$(".alert-mdp span").html('Votre mot de passe doit contenir au moins 5 caractères !');
			$(".alert-mdp").show("slow").delay(2000).hide("slow");
			return false;
		}
		else {			  /*Le mot de passe est correct*/
			$("div.matricule-mdp div.mdp").addClass("has-success").removeClass("has-error");
			$("div.alert-mdp").addClass("alert-success").removeClass("alert-danger");
			$(".alert-mdp span").html('Mot de passe correct !');
			$(".alert-mdp").show("slow").delay(1000).hide("slow");
		}
	});
Ç});