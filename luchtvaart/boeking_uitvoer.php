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


$boeking = explode(',', gebruikersInvoer('boeking'));
$Vlucht_Nr = $boeking[0];
$Luchtvaartmaatschappij_ID = $boeking[1];
$Zitplaats_Nr = $boeking[2];
$vertrek = $boeking[3];
$aankomst = $boeking[4];
$klasse = $boeking[5];
$naam_vertrek = $boeking[6];
$naam_aankomst = $boeking[7];

	$query = "INSERT INTO `WordtGeboektDoor`(`Klant_ID`, `Reisbureau_ID`, `Zitplaats_Nr`, `Luchtvaartmaatschappij_ID`, `Vlucht_Nr`) 
				VALUES (
				   ". $_SESSION['Klant_ID'] .
				"," . $_SESSION['reisbureau'] . 
				"," . $Zitplaats_Nr . 	
				"," . $Luchtvaartmaatschappij_ID .
				"," . $Vlucht_Nr . 
				");";

	$result = mysql_query($query) or die("De boeking is niet gelukt: " . mysql_error());
	
	$luchthavenquery = "SELECT SUM(Tax) FROM Luchthaven WHERE Luchthaven_ID = " . $vertrek . " OR Luchthaven_ID = " . $aankomst;

	$tax = mysql_query($luchthavenquery) or die("Berekeing tax niet gelukt: " .mysql_error());


	$klasseprijsquery = "SELECT Prijs FROM `Klasse` WHERE Type = '" . $klasse . "'";
	
	$klasseprijs = mysql_query($klasseprijsquery) or die("Berekening klasseprijs niet gelukt: " .mysql_error());
	
	$tot = mysql_fetch_array($tax,MYSQL_NUM);

	$aal = mysql_fetch_array($klasseprijs,MYSQL_NUM);

	$totaal = $tot[0] + $aal[0];

?>
<?php
if (!mysql_error())
echo "De vlucht voor " .$_SESSION['klant_voornaam']. " " . $_SESSION['klant_achternaam'] . 
" van " . $naam_vertrek . " naar " .$naam_aankomst . " is succesvolgeboekt voor een prijs van €" . $totaal;
?>
<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>