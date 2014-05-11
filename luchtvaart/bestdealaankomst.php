<?php
require('database.inc');
$title = 'Selecteer een bestemming';
require("top.inc");
?>

<?php
$_SESSION['vertrek'] = gebruikersInvoer('luchthavenvanherkomst');

$query = "SELECT DISTINCT LuchthavenVanBestemming, Land, Naam
FROM Vlucht as v JOIN Luchthaven as l ON l.Luchthaven_ID = v.LuchthavenVanBestemming 
WHERE v.LuchthavenVanHerkomst = " . $_SESSION['vertrek'] . "
ORDER BY Land, Naam";

?>

<form action="bestdeal.php">
    <p><em>Luchthaven van bestemming:</em>
    <select name="luchthavenvanbestemming">
<?php
$resultaat = mysql_query($query) or die("Kan lijst niet opvragen" . mysql_error());

while($rij = mysql_fetch_array($resultaat, MYSQL_ASSOC)) {
    echo "<option value=\"". $rij['LuchthavenVanBestemming'] ."\">" .$rij['Land'] . ' ' . $rij['Naam'] . "</option>";
}
?>
</select>

</p>
    <p><em>Klasse:</em>

 <select name="klasseprijs"

        <?php
        $klassequery = "SELECT * FROM Klasse ORDER BY Prijs";
        $kp = mysql_query($klassequery) or die ("Kan prijslijst niet opvragen" . mysql_error());

        while($rij = mysql_fetch_array($kp, MYSQL_ASSOC)){
            print_r($rij);
            echo "<option value=\"". $rij['Prijs'] . "\">" . $rij['Type'] . ' ' . $rij['Prijs'] . "</option>";
        }
        ?>

        </select>
        </p>
<input type="submit" value="Selecteer"/>
</form>
<?php
require("bottom.inc");
?>