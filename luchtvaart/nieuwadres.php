<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Stel een nieuw adres in';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");
?>

<!-- Dit is het formulier om het adres in te geven: -->
<form action="nieuwadres_uitvoer.php">
<p><em>Klant:</em>
<select name="naam">
<?php
	$query = "SELECT Familienaam, Voornaam FROM Klant ORDER BY Familienaam";
	$resultaat = mysql_query($query) or die("Kan de lijst van klanten niet opvragen: " . mysql_error());
	while($rij = mysql_fetch_array($resultaat)) {
		echo "<option value=\"". $rij['Voornaam'] . ',' . $rij['Familienaam'] . "\">" .$rij['Familienaam'] . ' ' . $rij['Voornaam'] . "</option>";
	}
?>
</select></p>

<em>Nieuwe straatnaam:</em> <input type="text" name="straat" length="40"/><br />
<em>Nieuw huisnummer:</em> <input type="number" name="nummer" length="15"/><br />

<!-- De knop waarop de gebruiker kan klikken. -->
<input type="submit" value="Aanpassen"/>
</form>


<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>