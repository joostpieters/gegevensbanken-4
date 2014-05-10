<?php
require('database.inc');
$title = 'Selecteer een vertrekpunt';
require("top.inc");
?>

<?php
$_SESSION['vertrek'] = gebruikersInvoer('luchthavenvanherkomst');

$query = "SELECT LuchthavenVanBestemming, Land, Naam
FROM Vlucht as v JOIN Luchthaven as l
ON l.Luchthaven_ID = v.LuchthavenVanBestemming WHERE v.LuchthavenVanHerkomst = " . $_SESSION['vertrek'];

?>

<form action="bestdealaankomst.php">
    <em>Luchthaven van bestemming:</em>
    <select name="luchthavenvanbestemming">
<?php
$resultaat = mysql_query($query) or die("Kan lijst niet opvragen" . mysql_error());

while($rij = mysql_fetch_array($resultaat, MYSQL_ASSOC)) {
    echo "<option value=\"". $rij['Luchthaven_ID'] ."\">" .$rij['Land'] . ' ' . $rij['Naam'] . "</option>";
}
?>
        <input type="submit" value="Selecteer"/>
</form>
<?php
require("bottom.inc");
?>