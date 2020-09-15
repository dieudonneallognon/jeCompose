$(function() {
	
/*-------------------------------------------- Effet de la page active dans le navigateur -----------------------------------------------------*/

	$('ul.nav li:first-child').addClass('active');
	$('div.navigateur p a[href="index.php"]').addClass('actif');

/*--------------------------------------------------- Effet du panneau des règles --------------------------------------------------------------*/

	$(".btn-block").click(function() {
		$(".btn-block").hide();
		$(".panel").show("slow");
	});
	$(".btn-xs").click(function() {
		$(".panel").hide("slow");
		$(".btn-block").show();
	});
});