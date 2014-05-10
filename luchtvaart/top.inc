<?php
// Onderstaande lijnen zijn instructies voor de web-browser over hoe ze een pagina moet
// implementeren.
session_start();
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl-BE" lang="nl-BE">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php // s ?>
	<title><?php print $title;?></title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div class="navigation">
<h2 class="indexTitle"></h2>
    <center>
    <p><a href="index.php" class="button"/>Voorpagina</a>
       <a href="klanten.php" class="button"/>Klantenlijst</a>
       <a href="luchtvaartmaatschappijen.php" class="button"/>Luchtvaartmaatschappijen</a>
       <a href="zoeken.php" class="button"/>Vluchtzoeker</a>
       <a href="nieuwadres.php" class="button"/>Nieuw adres</a>
       <a href="boeking_selecteerreisbureau.php" class="button"/>Boek Vlucht</a>
       <a href="zoekbestdeal.php" class="button"/>Best Deal</a>
    </p>
    </center>


</div>
<div class="main">
<h2 class="contentTitle"><?php print $title;?></h2>