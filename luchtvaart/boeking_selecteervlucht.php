<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Een vlucht boeken';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");	
?>
<?php
//Aangezien we de klant later nog gebruiken, gaan we deze waarde die in $_GET zit opslaan in $_SESSION

$naam = explode(',', gebruikersInvoer('klant'));
$_SESSION['klant_voornaam'] = $naam[0];
$_SESSION['klant_achternaam'] = $naam[1];
?>
<!-- Dit is het formulier om de ontlening te bevestigen: -->


<!-- Voeg hier je code toe 
SELECT DISTINCT Zitplaats.Vlucht_Nr, Zitplaats.Zitplaats_Nr, Zitplaats.Klasse  From Zitplaats
LEFT JOIN WordtGeboektDoor ON Zitplaats.Vlucht_Nr = WordtGeboektDoor.Vlucht_Nr and Zitplaats.Zitplaats_Nr = WordtGeboektDoor.Zitplaats_Nr
WHERE WordtGeboektDoor.Vlucht_Nr IS NULL and WordtGeboektDoor.Zitplaats_Nr IS NULL 
ORDER BY Vlucht_Nr, Klasse
-->
	<table>
	<tr><td>Vertrek</td><td>Aankomst</td><td>Klasse</td><td>Luchtvaartmaatschappij_ID</td></tr>
<?php
	$query = "SELECT k.naam, l.naam, z.Vlucht_Nr, z.Zitplaats_Nr, z.Klasse, z.Luchtvaartmaatschappij_ID  From Zitplaats AS z
LEFT JOIN WordtGeboektDoor AS w ON z.Vlucht_Nr = w.Vlucht_Nr and z.Zitplaats_Nr = w.Zitplaats_Nr
INNER JOIN Vlucht as v ON v.Vlucht_Nr = z.Vlucht_Nr
INNER JOIN Luchthaven AS k ON k.Luchthaven_ID = v.LuchthavenVanHerkomst
INNER JOIN Luchthaven AS l ON l.Luchthaven_ID = v.LuchthavenVanBestemming
WHERE w.Vlucht_Nr IS NULL and w.Zitplaats_Nr IS NULL 
ORDER BY k.Naam, z.Vlucht_Nr, z.Klasse, z.Zitplaats_Nr";
	$result = mysql_query($query) or die("Database fout: " . mysql_error());

	while( $entry = mysql_fetch_array($result, MYSQL_ASSOC) ) {
		
?>
	<tr>
		<td><?php echo $entry['Klasse']; ?></td>
		<td><?php echo $entry['Klasse']; ?></td>
		<td><?php echo $entry['Klasse']; ?></td>
		<td<<?php echo $entry['Luchtvaartmaatschappij_ID'];?> </td>
		<td><form action="boeking_uitvoer.php">
			<input type="submit" value="Kies klant"/>
			</form></td>
	</tr>
<?php
	}
	$key = array_search('Madang', $result);
?>
	</table>
<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>