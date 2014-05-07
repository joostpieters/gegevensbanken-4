<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Best Deal - rechtstreekse vluchten';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");
	
	// Variabelen toewijzen
	$luchthavenvanherkomst = gebruikersInvoer('luchthavenvanherkomst');
	$luchthavenvanbestemming = gebruikersInvoer('luchthavenvanbestemming');
	$klasseprijs = gebruikersInvoer('klasse');

	// Voer deze query uit en sla het result op in $result.
	$query = "SELECT Vlucht_Nr,  Vertrektijd, Aankomsttijd, (H.Tax + B.Tax) AS SUM_TAX
			FROM Vlucht, Luchthaven as H, Luchthaven as B
			WHERE LuchthavenVanHerkomst = $luchthavenvanherkomst
			AND LuchthavenVanBestemming = $luchthavenvanbestemming
			AND H.Luchthaven_ID = $luchthavenvanherkomst
			AND B.Luchthaven_ID = $luchthavenvanbestemming
			ORDER BY SUM_TAX";
	$result = mysql_query($query) or die("Database fout: " . mysql_error());
?>
<table>
	<tr><td>Vluchtnummer</td><td>Vertrektijd</td><td>Aankomsttijd</td><td>Prijs</td></tr>
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($result, MYSQL_ASSOC) ) { ?>
	
	<?php
	// Berekening van de prijs:
	$prijs = $entry[SUM_TAX] + $klasseprijs
	?>
	
	<tr>
		<td><?php echo $entry['Vlucht_Nr']; ?></td>
		<td><?php echo $entry['Vertrektijd']; ?></td>
		<td><?php echo $entry['Aankomsttijd']; ?></td>
		<td><?php echo $prijs; ?></td>
	</tr>
	<?php } ?>
</table>
<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>