<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Zoek de goedkoopste vlucht voor jouw bestemming';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");
?>

<!-- Dit is het formulier om het adres in te geven: -->
<form action="zoekbestdealrechtstreeks.php">
<p><em>Luchthaven van herkomst:</em>
<select name="luchthavenvanherkomst">
<?php
	$query = "SELECT Luchthaven_ID, Naam, Land FROM Luchthaven ORDER BY Land, naam";
	$resultaat = mysql_query($query) or die("Kan de lijst van luchthavens niet opvragen: " . mysql_error());
	while($rij = mysql_fetch_array($resultaat)) {
		echo "<option value=\"". $rij['Luchthaven_ID'] ."\">" .$rij['Land'] . ' ' . $rij['Naam'] . "</option>";
	}
?>
</select></p>
<p><em>Luchthaven van bestemming:</em>
<select name="luchthavenvanbestemming">
<?php
	$query = "SELECT Luchthaven_ID, Naam, Land FROM Luchthaven ORDER BY Land, naam";
	$resultaat = mysql_query($query) or die("Kan de lijst van luchthavens niet opvragen: " . mysql_error());
	while($rij = mysql_fetch_array($resultaat)) {
		echo "<option value=\"". $rij['Luchthaven_ID'] ."\">" .$rij['Land'] . ' ' . $rij['Naam'] . "</option>";
	}
?>
</select></p>
<p><em>Klasse:</em>
<select name="klasse">
<?php
	$query = "SELECT Type, Prijs FROM Klasse ORDER BY Prijs";
	$resultaat = mysql_query($query) or die("Kan de lijst van klasses niet opvragen: " . mysql_error());
	while($rij = mysql_fetch_array($resultaat)) {
		echo "<option value=\"". $rij['Prijs'] ."\">" .$rij['Type'] . ' ' . $rij['Prijs'] . "</option>";
	}
?>
</select></p>


<!-- De knop waarop de gebruiker kan klikken. -->
<input type="submit" value="Zoek best deal"/>
</form>

<!-- Dit is het formulier om het adres in te geven: -->
<form action="zoekbestdealmettussenstop.php">
<p><em>Luchthaven van herkomst:</em>
<select name="luchthavenvanherkomsttussenstop">
<?php
	$query = "SELECT Luchthaven_ID, Naam, Land FROM Luchthaven ORDER BY Land, naam";
	$resultaat = mysql_query($query) or die("Kan de lijst van luchthavens niet opvragen: " . mysql_error());
	while($rij = mysql_fetch_array($resultaat)) {
		echo "<option value=\"". $rij['Luchthaven_ID'] ."\">" .$rij['Land'] . ' ' . $rij['Naam'] . "</option>";
	}
?>
</select></p>
<p><em>Luchthaven van bestemming:</em>
<select name="luchthavenvanbestemmingtussenstop">
<?php
	$query = "SELECT Luchthaven_ID, Naam, Land FROM Luchthaven ORDER BY Land, naam";
	$resultaat = mysql_query($query) or die("Kan de lijst van luchthavens niet opvragen: " . mysql_error());
	while($rij = mysql_fetch_array($resultaat)) {
		echo "<option value=\"". $rij['Luchthaven_ID'] ."\">" .$rij['Land'] . ' ' . $rij['Naam'] . "</option>";
	}
?>
</select></p>


<!-- De knop waarop de gebruiker kan klikken. -->
<input type="submit" value="Zoek best deal met (eventueel) een tussenstop"/>
</form>


<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>