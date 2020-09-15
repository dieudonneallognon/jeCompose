$(function () {
	
/*-------------------------------------------- Effet de la page active dans le navigateur -----------------------------------------------------*/
	
	$('ul.nav li:nth-child(2)').addClass('active');
	$('div.navigateur p a[href="gerer_matieres.php"]').addClass('actif');
	
	$("input[type='checkbox']").click(function() {
		$('input.btn').removeAttr('disabled');
		$("input[type='checkbox']").click(function() {
			$('input.btn').add('disabled');
		});
	});
	
	
});
