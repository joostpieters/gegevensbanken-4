<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Een vlucht boeken';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");
?>

<!-- Voeg hier je code toe -->
<?php

print_r($_GET);

$boeking = explode(',', gebruikersInvoer('Vlucht_Nr'));
$Vlucht_Nr = $boeking[0];
$Luchtvaartmaatschappij_ID = $boeking[1];
$Zitplaats_Nr = $boeking[2];

	$query = "INSERT INTO `WordtGeboektDoor`(`Klant_ID`, `Reisbureau_ID`, `Zitplaats_Nr`, `Luchtvaartmaatschappij_ID`, `Vlucht_Nr`) 
				VALUES (
				   ". $_SESSION['Klant_ID'] .
				"," . $_SESSION['reisbureau'] . 
				"," . $Zitplaats_Nr . 
				
				"," . $Luchtvaartmaatschappij_ID .
				"," . $Vlucht_Nr . 
				");";

	$result = mysql_query($query) or die("Database fout: " . mysql_error());
?>
<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>