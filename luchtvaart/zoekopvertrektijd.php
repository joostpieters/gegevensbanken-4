<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Zoeken op vertrektijd';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

	// Voer deze query uit en sla het result op in $result.
	// LIKE omdat bij vertrektijd ook de tijd staat maar enkel de datum wordt ingegeven bij de gebruikersinvoer. (vandaar ook het %). 
	$query = "SELECT Vlucht_Nr FROM Vlucht WHERE Vertrektijd LIKE '" . gebruikersInvoer('vertrektijd') . "%';";
	$result = mysql_query($query) or die("Database fout: " . mysql_error());
?>
<table>
	<tr><td>Vluchtnummer</td></tr>
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($result, MYSQL_ASSOC) ) { ?>
	<tr>
		<td><?php echo $entry['Vlucht_Nr']; ?></td>
	</tr>
	<?php } ?>
</table>
<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>