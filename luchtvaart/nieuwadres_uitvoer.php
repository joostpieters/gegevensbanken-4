<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Stel een nieuw adres in';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

// Implementeer je code hier.
$naam = gebruikersInvoer('naam');
$straat = gebruikersInvoer('straat');
$nummer = gebruikersInvoer('nummer');

// Voer deze query uit en sla het result op in $result.
	// LIKE omdat bij vertrektijd ook de tijd wordt gegeven en we deze niet nodig hebben en dus niet mee vergelijken (hiervoor ook dat %) 
	$query = "UPDATE klant SET Straat = '".$straat."', Nummer = '".$nummer."' WHERE Naam = '".$naam."';";
	$result = mysql_query($query) or die("Database fout: " . mysql_error());


// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>
