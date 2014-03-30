<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Stel een nieuw adres in';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

// Implementeer je code hier.
// we krijgen de string "voornaam,achternaam" mee, deze exploden we en kennen we toe aan $voornaam en $achternaam
$naam = explode(',', gebruikersInvoer('naam'));
$voornaam = $naam[0];
$achternaam = $naam[1];
$straat = gebruikersInvoer('straat');
$nummer = gebruikersInvoer('nummer');

// Voer deze query uit en sla het result op in $result.
	$query = "UPDATE Klant SET Straat = '".$straat."', Nummer = '".$nummer."' WHERE Voornaam = '".$voornaam."' and Familienaam = '".$achternaam."';";

	$result = mysql_query($query) or die("Database fout: " . mysql_error());

if (!mysql_error())
echo "Het adres van " .$voornaam. " " . $achternaam . " is succesvol geupdated naar: " .$straat. " " . $nummer . ".";

// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>
