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
$klasseprijs = gebruikersInvoer('klasse');

// Voer deze query uit en sla het result op in $result. 
// // //(Ik heb hier distinct moeten bijzetten omdat ik anders 1000 keer hetzelfde kreeg, maar misschien lag da aan iets anders...)
// // //Zonder tussenstop
	$query1 = "SELECT DISTINCT Vlucht_Nr AS Vlucht_Nr1, AantalStops, (H.Tax + B.Tax) AS Tax 
	FROM Vlucht, Luchthaven AS H, Luchthaven as B
	WHERE LuchthavenVanHerkomst = '".$IDherkomst."' 
	and LuchthavenVanBestemming = '".$IDbestemming."' 
	and H.Luchthaven_ID = '".$IDherkomst."' 
	and B.Luchthaven_ID = '".$IDbestemming."' 
	ORDER BY Tax;";
	$result1 = mysql_query($query1) or die("Database fout: " . mysql_error());
// // //Met tussenstop
	$query2 = "SELECT DISTINCT H.Vlucht_Nr AS Vlucht_Nr1, (H.AantalStops + B.AantalStops + 1) AS AantalStops, B.vlucht_Nr AS Vlucht_Nr2, (V.Tax + A.Tax + T.Tax) AS Tax 
	FROM (Vlucht AS B JOIN VLucht AS H ON B.LuchthavenVanHerkomst = H.LuchthavenVanBestemming), Luchthaven AS V, Luchthaven as A, Luchthaven T
	WHERE H.LuchthavenVanHerkomst = '".$IDherkomst."' 
	and B.LuchthavenVanBestemming = '".$IDbestemming."' 
	and V.Luchthaven_ID = '".$IDbestemming."' 
	and A.Luchthaven_ID = '".$IDherkomst."' 
	and T.Luchthaven_ID = B.LuchthavenVanHerkomst
	and H.Aankomsttijd < B.Vertrektijd
	ORDER BY Tax;";	
	$result2 = mysql_query($query2) or die("Database fout: " . mysql_error());
?>
<table>
	<tr><td>Vlucht1</td><td>Vlucht2</td><td>tussenstops</td><td>prijs</td></tr>
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($result1, MYSQL_ASSOC)) { ?>
	
	<?php
	// Berekening van de prijs:
	$prijs = $entry['Tax'] + $klasseprijs
	?>
	
	<tr>
		<td><?php echo $entry['Vlucht_Nr1']; ?></td>
		<td><?php echo "/"; ?></td>
		<td><?php echo $entry['AantalStops']; ?></td>
		<td><?php echo $prijs; ?></td>
	</tr>
	<?php } ?>
	
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($result2, MYSQL_ASSOC)) { ?>
	
	<?php
	// Berekening van de prijs:
	$prijs = $entry['Tax'] + $klasseprijs
	?>
	
	<tr>
		<td><?php echo $entry['Vlucht_Nr1']; ?></td>
		<td><?php echo $entry['Vlucht_Nr2']; ?></td>
		<td><?php echo $entry['AantalStops']; ?></td>
		<td><?php echo $prijs; ?></td>
	</tr>
	<?php } ?>
</table>

<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>
