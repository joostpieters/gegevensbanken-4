<?php
	// Voer de inhoud van "database.inc" uit. Dit is PHP-code
	// die de verbinding met de database aangaat.
	require('database.inc');

	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Luchtvaart database";

	// Voer de inhoud van "top.inc" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("top.inc");
?>

Dit is een web-pagina.<br /><br />
<?php print "Dit is een stuk PHP code.<br />"; ?>

<?php
	//Plaats hier je code
	echo rand(1,20);
?>.

<?php
// Voer de inhoud van "bottom.inc" uit. Dit sluit de pagina af
// en verbreekt de verbinding met de database.
require("bottom.inc");
?>