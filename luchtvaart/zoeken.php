<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Vluchtinformatie opzoeken';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");
?>

<!-- Dit is het formulier om te zoeken op aantal stops: -->
<form action="zoekopaantalstops.php">
<em>aantal stops:</em> <input type="text" name="aantalstops" length="2"/><br />

<!-- De knop waarop de gebruiker kan klikken. -->
<input type="submit" value="Zoek op aantal stops"/>
</form>

<!-- Dit is het formulier om te zoeken op vertrektijd: -->
<form action="zoekopvertrektijd.php">
<em>Vertrektijd (jjjj-mm-dd):</em> <input type="text" name="vertrektijd" length="10"/><br />

<!-- De knop waarop de gebruiker kan klikken. -->
<input type="submit" value="Zoek op vertrektijd"/>
</form>

<!-- Dit is het formulier om te zoeken op luchthaven van herkomst: -->
<form action="zoekopoorsprong.php">
<em>Luchthaven van herkomst:</em> <input type="text" name="luchthavenvanherkomst" /><br />

<!-- De knop waarop de gebruiker kan klikken. -->
<input type="submit" value="Zoek op luchthaven"/>
</form>


<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>