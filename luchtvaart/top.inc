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
<h2 class="indexTitle">Index</h2>
<ul>
	<li><a href="index.php">Voorpagina</a></li>
	<li><a href="klanten.php">Lijst van klanten</a></li>
	<li><a href="luchtvaartmaatschappijen.php">Lijst van luchtvaartmaatschappijen in de US</a></li>
	<li><a href="zoeken.php">Vluchtzoeker</a></li>
	<li><a href="nieuwadres.php">Stel een nieuw adres in</a></li>
	<li><a href="boeking_selecteerreisbureau.php">Boek vlucht</a></li>
	
</ul>
</div>
<div class="main">
<h2 class="contentTitle"><?php print $title;?></h2>