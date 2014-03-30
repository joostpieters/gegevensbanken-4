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
$_SESSION['Klant_ID'] = $naam[0];
$_SESSION['klant_voornaam'] = $naam[1];
$_SESSION['klant_achternaam'] = $naam[2];
?>
<!-- Dit is het formulier om de ontlening te bevestigen: -->


<!-- Voeg hier je code toe -->
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

	while( $entry = mysql_fetch_array($result) ) {

?>
	
	<tr>
		<td><?php echo $entry[0]; ?></td>
		<td><?php echo $entry['naam']; ?></td>
		<td><?php echo $entry['Klasse']; ?></td>
		<td><?php echo $entry['Luchtvaartmaatschappij_ID']; ?></td>
		
		<td><form action="boeking_uitvoer.php">
			<?php // De info voor de boeking meegeven?>
			
			<input type ='hidden' name=Vlucht_Nr value="<?php echo $entry['Vlucht_Nr'] ?>"/>
			
			<input type ='hidden' name=Luchtvaartmaatschappij_ID="<?php echo $entry['Luchtvaartmaatschappij_ID'] ?>"/>
			
			<input type ='hidden' name=Zitplaats_Nr="<?php echo $entry['Zitplaats_Nr'] ?>"/>
			
			<input type ='hidden' name=Kland_ID="<?php $_SESSION['Klant_ID']?>"/>
			
			<input type ='hidden' name=Reisbureau_ID="<?php $_SESSION['reisbureau']?>"/>
				
			<input type="submit" value="Kies klant"/>
		</form></td>
	</tr>
	
<?php
	}

?>
	</table>

<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>