<?php
echo "<h1>Tiere</h1>";

// include_once "tier.inc.php";
// include_once "tier/hund.inc.php";
// include_once "tier/katze.inc.php";

// Der Autoloader erhält Klassennamen, die noch nicht included wurden. Diesen können
// wir in einen Dateipfad umwandeln und die Datei danach einbinden. Wird für
// jede Klasse bei der ersten Verwendung automatisch aufgerufen ("lazy loading").
spl_autoload_register(function($klasse) {
    // $klasse = tier_hund -> tier/hund.inc.php
    // https://www.php.net/str_replace
    $pfad = str_replace("_", "/", $klasse);
    $pfad .= ".inc.php";
    include_once $pfad;
});

$hund = new tier_hund_dogge("Spike");
$katze = new tier_katze("Tom");
$maus = new tier_maus("Jerry");

$tiere = new tiere();
$tiere->add($maus); // 0
$tiere->add($hund); // 1
$tiere->add($katze); // 2

echo $tiere->ausgabe();

// Verwendung der Iterator-Implementierung aus der "tiere" Klasse
foreach ($tiere as $t) {
    echo "<br>";
    echo $t->get_name();
}
