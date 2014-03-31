<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Een vlucht boeken';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");
?>

<!-- Dit is het formulier om de klant in te geven: -->
<form action="boeking_selecteerklant.php">


<p><em>Reisbureau:</em>
<select name="reisbureau">
<?php
// De query die alle reisbureaus ophaalt.
	$query = "SELECT Reisbureau_ID, Straat, Nummer FROM Reisbureau ORDER BY Reisbureau_ID";
	$resultaat = mysql_query($query) or die("Kan de lijst van reisbureaus niet opvragen: " . mysql_error());
	while($rij = mysql_fetch_array($resultaat)) {
		echo "<option value=\"". $rij['Reisbureau_ID']  . "\">" .$rij['Reisbureau_ID'] . " " . $rij['Straat'] . " " .$rij['Nummer'] . "</option>";
	}
?>
</select>

<input type="submit" value="Selecteer Reisbureau"/>
</form>

<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>