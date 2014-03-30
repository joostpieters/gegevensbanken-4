<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Een vlucht boeken';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");
?>

<!-- Dit moet het formulier worden om de vlucht in te geven: -->
<form action="boeking_selecteervlucht.php">

<?php
//Aangezien we het reisbureau later nog gebruiken, gaan we deze waarde die in $_GET zit opslaan in $_SESSION
$_SESSION['reisbureau'] = gebruikersInvoer('reisbureau');

?>

<!-- Voeg hier je code toe. -->
<p><em>Klant:</em>
<select name="klant">
<?php
	$query = "SELECT Familienaam, Voornaam, Klant_ID FROM Klant ORDER BY Familienaam";
	$resultaat = mysql_query($query) or die("Kan de lijst van klanten niet opvragen: " . mysql_error());
	while($rij = mysql_fetch_array($resultaat)) {
		echo "<option value=\"". $rij['Klant_ID'] . ',' . $rij['Voornaam'] . ',' . $rij['Familienaam'] . "\">" .$rij['Familienaam'] . ' ' . $rij['Voornaam'] . "</option>";
	}
?>
</select></p>

<input type="submit" value="Kies klant"/>
</form>


<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>