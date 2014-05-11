<?php
require('database.inc');
$title = 'Beste deals';
require("top.inc");
?>

<?php
$_SESSION['aankomst'] = gebruikersInvoer('luchthavenvanbestemming');
$_SESSION['klasseprijs'] = gebruikersInvoer('klasseprijs');

$query = "(SELECT DISTINCT Vlucht_Nr AS Vlucht_Nr1, AantalStops, \"Geen\" AS Vlucht_Nr2, (H.Tax + B.Tax) AS Tax
	FROM Vlucht, Luchthaven AS H, Luchthaven as B
	WHERE LuchthavenVanHerkomst = '". $_SESSION['vertrek'] ."'
and LuchthavenVanBestemming = '". $_SESSION['aankomst'] ."'
and H.Luchthaven_ID = '". $_SESSION['vertrek'] ."'
and B.Luchthaven_ID = '". $_SESSION['aankomst'] ."')

UNION

(SELECT DISTINCT H.Vlucht_Nr AS Vlucht_Nr1, (H.AantalStops + B.AantalStops + 1) AS AantalStops, B.vlucht_Nr AS Vlucht_Nr2, (V.Tax + A.Tax + T.Tax) AS Tax
	FROM (Vlucht AS B JOIN Vlucht AS H ON B.LuchthavenVanHerkomst = H.LuchthavenVanBestemming), Luchthaven AS V, Luchthaven as A, Luchthaven T
	WHERE H.LuchthavenVanHerkomst = '". $_SESSION['vertrek'] ."'
	and B.LuchthavenVanBestemming = '". $_SESSION['aankomst'] ."'
	and V.Luchthaven_ID = '". $_SESSION['aankomst'] ."'
	and A.Luchthaven_ID = '". $_SESSION['vertrek'] ."'
	and T.Luchthaven_ID = B.LuchthavenVanHerkomst
	and H.Aankomsttijd < B.Vertrektijd
	and TIMESTAMPDIFF(DAY, B.Vertrektijd, H.Vertrektijd) < 10
	)
ORDER BY Tax";
//print_r($query);
$result = mysql_query($query) or die("Database fout: " . mysql_error());
?>
<table>
    <tr><td>Vlucht1</td><td>Vlucht2</td><td>tussenstops</td><td>prijs</td></tr>
<?php while( $entry = mysql_fetch_array($result, MYSQL_ASSOC)) { ?>

    <?php
    // Berekening van de prijs:
    $prijs = $entry['Tax'] + $_SESSION['klasseprijs'];
    ?>

    <tr>
        <td><?php echo $entry['Vlucht_Nr1']; ?></td>
        <td><?php echo $entry['Vlucht_Nr2']; ?></td>
        <td><?php echo $entry['AantalStops']; ?></td>
        <td><?php echo $prijs; ?></td>
    </tr>
<?php } ?>
</table>

<?php
require("bottom.inc");
?>