<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Zoeken op vluchtnummer';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

	// Voer deze query uit en sla het result op in $result.
	$query = "SELECT Vertrektijd, Aankomsttijd, AantalStops, H.Naam AS NaamH, H.Land AS LandH, H.BediendeStad AS StadH, B.Naam AS NaamB, B.Land AS LandB, B.BediendeStad AS StadB
	FROM Vlucht, Luchthaven AS H, Luchthaven AS B
	WHERE Vlucht_Nr = " . gebruikersInvoer('vluchtnummer') . "
	AND LuchthavenVanHerkomst = H.Luchthaven_ID
	AND LuchthavenVanBestemming = B.Luchthaven_ID ;";
	$result = mysql_query($query) or die("Database fout: " . mysql_error());
?>
<table>
	<tr><td>Vertrektijd</td><td>Aankomsttijd</td><td>Tussenstops</td><td>  VAN Luchthaven</td><td>Land</td><td>Stad</td><td>   NAAR Luchthaven</td><td>Land</td><td>Stad</td></tr>
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($result, MYSQL_ASSOC) ) { ?>
	<tr>
		<td><?php echo $entry['Vertrektijd']; ?></td>
		<td><?php echo $entry['Aankomsttijd']; ?></td>
		<td><?php echo $entry['AantalStops']; ?></td>
		<td><?php echo $entry['NaamH']; ?></td>
		<td><?php echo $entry['LandH']; ?></td>
		<td><?php echo $entry['StadH']; ?></td>
		<td><?php echo $entry['NaamB']; ?></td>
		<td><?php echo $entry['LandB']; ?></td>
		<td><?php echo $entry['StadB']; ?></td>
	</tr>
	<?php } ?>
</table>
<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>