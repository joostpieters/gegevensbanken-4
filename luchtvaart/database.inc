<?php
// Initaliseer de databank-verbinding hier.
// Sla ze op in de variabele $conn.
// Vergeet niet op de server het juiste schema te selecteren met mysql_select_db

// De server waarop de database draait. XAMPP is een virtuele server, die op localhost draait.
$host = "localhost";

// Gebruikersnaam en wachtwoord. In XAMPP kan je je gebruikersnaam nagaan op de startpagina van
// PHPMyAdmin, onder 'MySQL' bij 'Gebruiker'.


// --- Plaats hier je code die er voor zorgt dat er verbinding wordt gemaakt met de database.


// Helpfunctie om GET-variabele <$name> op te vragen en speciale karakters te geschikt te maken
// voor gebruik in SQL-query (om SQL injection te voorkomen)
function gebruikersInvoer($name) {
	return mysql_real_escape_string($_GET[$name]);
}?>