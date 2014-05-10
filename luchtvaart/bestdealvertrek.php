<?php
require('database.inc');
$title = 'Selecteer een vertrekpunt';
require("top.inc");
?>

<?php
$_SESSION['luchthavenquery'] = "SELECT DISTINCT Luchthaven_ID, Land, Naam FROM Luchthaven as l JOIN Vlucht as v ON l.Luchthaven_ID = v.LuchthavenVanHerkomst ORDER  BY Land, Naam";
$_SESSION['klassequery'] = "SELECT Type, Prijs FROM Klasse ORDER BY Prijs";
?>


<form action="bestdealaankomst.php">
    <em>Luchthaven van herkomst:</em>
    <select name="luchthavenvanherkomst">
<?php
$resultaat = mysql_query($_SESSION['luchthavenquery']) or die("Kan de lijst van luchthavens niet opvragen: " . mysql_error());
while($rij = mysql_fetch_array($resultaat)) {
    echo "<option value=\"". $rij['Luchthaven_ID'] ."\">" .$rij['Land'] . ' ' . $rij['Naam'] . "</option>";
}
?>

    <!-- De knop waarop de gebruiker kan klikken. -->
    <input type="submit" value="Selecteer"/>
</form>



<?php
require("bottom.inc");
?>