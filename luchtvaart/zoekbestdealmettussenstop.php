<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Best Deal';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

// Implementeer je code hier.
// Variabelen toewijzen
$IDherkomst = gebruikersInvoer('luchthavenvanherkomsttussenstop');
$IDbestemming = gebruikersInvoer('luchthavenvanbestemmingtussenstop');
$klasse = gebruikersInvoer('klasse');

// Voer deze query uit en sla het result op in $result. 
// // //(Ik heb hier distinct moeten bijzetten omdat ik anders 1000 keer hetzelfde kreeg, maar misschien lag da aan iets anders...)
// // //Zonder tussenstop
	$query1 = "SELECT DISTINCT Vlucht_Nr AS Vlucht_Nr1, AantalStops AS AantalStops, (H.Tax + B.Tax + Prijs) AS Tax 
	FROM Vlucht, Luchthaven AS H, Luchthaven as B, Klasse
	WHERE LuchthavenVanHerkomst = '".$IDherkomst."' 
	and LuchthavenVanBestemming = '".$IDbestemming."' 
	and H.Luchthaven_ID = '".$IDherkomst."' 
	and B.Luchthaven_ID = '".$IDbestemming."' 
	and Type = '".$klasse."'
	ORDER BY Tax;";
	$result1 = mysql_query($query1) or die("Database fout: " . mysql_error());
// // //Met tussenstop
	$query2 = "SELECT DISTINCT H.Vlucht_Nr AS Vlucht_Nr1, (H.AantalStops + B.AantalStops + 1) AS AantalStops, B.vlucht_Nr AS Vlucht_Nr2, (V.Tax + A.Tax + T.Tax + Prijs) AS Tax 
	FROM (Vlucht AS B JOIN VLucht AS H ON B.LuchthavenVanHerkomst = H.LuchthavenVanBestemming), Luchthaven AS V, Luchthaven as A, Luchthaven T, Klasse
	WHERE H.LuchthavenVanHerkomst = '".$IDherkomst."' 
	and B.LuchthavenVanBestemming = '".$IDbestemming."' 
	and V.Luchthaven_ID = '".$IDbestemming."' 
	and A.Luchthaven_ID = '".$IDherkomst."' 
	and T.Luchthaven_ID = B.LuchthavenVanHerkomst
	and Type = '".$klasse."'
	ORDER BY Tax;";	
	$result2 = mysql_query($query2) or die("Database fout: " . mysql_error());
?>
<table>
	<tr><td>Vlucht1</td><td>Vlucht2</td><td>tussenstops</td><td>prijs</td></tr>
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($result1, MYSQL_ASSOC)) { ?>
	
	<tr>
		<td><?php echo $entry['Vlucht_Nr1']; ?></td>
		<td><?php echo "/"; ?></td>
		<td><?php echo $entry['AantalStops']; ?></td>
		<td><?php echo $entry['Tax']; ?></td>
	</tr>
	<?php } ?>
	
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($result2, MYSQL_ASSOC)) { ?>
	
	<tr>
		<td><?php echo $entry['Vlucht_Nr1']; ?></td>
		<td><?php echo $entry['Vlucht_Nr2']; ?></td>
		<td><?php echo $entry['AantalStops']; ?></td>
		<td><?php echo $entry['Tax']; ?></td>
	</tr>
	<?php } ?>
</table>

<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>
