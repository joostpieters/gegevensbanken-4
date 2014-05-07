<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'zoek de goedkoopste vlucht met eventueel tussenstops';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

// Implementeer je code hier.
// we krijgen de string "voornaam,achternaam" mee, deze exploden we en kennen we toe aan $voornaam en $achternaam
$IDherkomst = gebruikersInvoer('luchthavenvanherkomsttussenstop');
$IDbestemming = gebruikersInvoer('luchthavenvanbestemmingtussenstop');
$klasse = gebruikersInvoer('klasse');

//De query die de tax van de twee luchthaven ophaalt en de som al berekent.
	$luchthavenquery = "CREATE VIEW TaxView AS 
	SELECT Tax, Luchthaven_ID 
	FROM Luchthaven
	WHERE Luchthaven_ID = " . $IDherkomst . " OR Luchthaven_ID = " . $IDbestemming;
	

// Voer deze query uit en sla het result op in $result. 
// // //(Ik heb hier distinct moeten bijzetten omdat ik anders 1000 keer hetzelfde kreeg, maar misschien lag da aan iets anders...)
// // //Zonder tussenstop
	$query1 = "SELECT DISTINCT Vlucht_Nr AS Vlucht_Nr1, AantalStops AS AantalStops1 FROM Vlucht WHERE LuchthavenVanHerkomst = '".$IDherkomst."' and LuchthavenVanBestemming = '".$IDbestemming."' ;";
	$result1 = mysql_query($query1) or die("Database fout: " . mysql_error());
// // //Met tussenstop
	$query2 = "SELECT DISTINCT H.Vlucht_Nr AS Vlucht_Nr1, H.AantalStops AS AantalStops1, B.vlucht_Nr AS Vlucht_Nr2, B.AantalStops AS AantalStops2 
	FROM (Vlucht AS B JOIN VLucht AS H ON B.LuchthavenVanHerkomst = H.LuchthavenVanBestemming) 
	WHERE H.LuchthavenVanHerkomst = '".$IDherkomst."' and B.LuchthavenVanBestemming = '".$IDbestemming."';";	
	$result2 = mysql_query($query2) or die("Database fout: " . mysql_error());
?>
<table>
	<tr><td>Vlucht1</td><td>Vlucht2</td><td>tussenstopsVlucht1</td><td>tussenstopsVlucht2</td><td>klasse</td></tr>
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($result1, MYSQL_ASSOC)) { ?>
	
	<tr>
		<td><?php echo $entry['Vlucht_Nr1']; ?></td>
		<td><?php echo " "; ?></td>
		<td><?php echo $entry['AantalStops1']; ?></td>
		<td><?php echo " "; ?></td>
		<td><?php echo $klasse; ?></td>
	</tr>
	<?php } ?>
	
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($result2, MYSQL_ASSOC)) { ?>
	
	<tr>
		<td><?php echo $entry['Vlucht_Nr1']; ?></td>
		<td><?php echo $entry['Vlucht_Nr2']; ?></td>
		<td><?php echo $entry['AantalStops1']; ?></td>
		<td><?php echo $entry['AantalStops2']; ?></td>
		<td><?php echo $klasse; ?></td>
	</tr>
	<?php } ?>
</table>

<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>
