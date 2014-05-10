<?php
	// Voer de inhoud van "database.inc" uit. Dit is PHP-code
	// die de verbinding met de database aangaat.
	require('database.inc');

	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Klantenlijst";

	// Voer de inhoud van "top.inc" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("top.inc");
?>
	<table>
	<tr><td>Voornaam</td><td>Familienaam</td><td>Emailadres</td></tr>
<?php
	//Query om de klanten uit de database te halen.
	$query = "SELECT Voornaam, Familienaam, Emailadres FROM Klant ORDER BY Familienaam";
	$result = mysql_query($query) or die("Database fout: " . mysql_error());
	
	while( $entry = mysql_fetch_array($result, MYSQL_ASSOC) ) {
?>
	<tr>
		<td><?php echo $entry['Voornaam']; ?></td>
		<td><?php echo $entry['Familienaam']; ?></td>
		<td><?php echo $entry['Emailadres']; ?></td>
	</tr>
<?php
	}
?>
	</table>
<?php
	require("bottom.inc");
?>