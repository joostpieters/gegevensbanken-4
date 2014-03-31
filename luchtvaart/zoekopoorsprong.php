<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Zoeken op oorsprong';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

	// Voer deze query uit en sla het result op in $result.
	$query = "SELECT Vlucht_Nr, Naam, Vertrektijd, Aankomsttijd FROM Vlucht 
			JOIN Luchthaven ON LuchthavenVanBestemming=Luchthaven_ID 
			WHERE Vlucht_Nr IN(SELECT Vlucht_Nr FROM Vlucht 
			JOIN Luchthaven ON LuchthavenVanHerkomst=Luchthaven_ID 
			WHERE Naam = '" . gebruikersInvoer('luchthavenvanherkomst') . "');";
	$result = mysql_query($query) or die("Database fout: " . mysql_error());
?>
<table>
	<tr><td>Vluchtnummer</td><td>Bestemming</td><td>Vluchtduur</td></tr>
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($result, MYSQL_ASSOC) ) { ?>
	
	<?php
	// Berekening van de vluchtduur:
	$datetime1 = new DateTime(substr($entry['Vertrektijd'], 0, 10));
	$datetime2 = new DateTime(substr($entry['Aankomsttijd'], 0, 10));
	$interval = $datetime1->diff($datetime2);
	?>
	
	<tr>
		<td><?php echo $entry['Vlucht_Nr']; ?></td>
		<td><?php echo $entry['Naam']; ?></td>
		<td><?php echo $interval->format('%R%a days'); ?></td>
	</tr>
	<?php } ?>
</table>
<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>