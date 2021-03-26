<?php
// Klassendefinition einbinden
include_once "person.inc.php";

// Objekt erzeugen aus Klasse "person" = Instanz erstellen / instanzieren
$ich = new person("Markus");
echo $ich->vorstellen();
echo "<br>";
echo $ich->get_vorname();
echo "<br>";

// Weiteres Objekt erzeugen
$sie = new person("Sabrina");
echo $sie->vorstellen();
echo "<br>";

$sie->set_vorname("Julia");
echo $sie->vorstellen();
echo "<br>";
