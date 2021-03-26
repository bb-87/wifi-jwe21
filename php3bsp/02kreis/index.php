<?php
echo "<h1>Kreis</h1>";

include_once "kreis.inc.php";

$k1 = new kreis(3);

echo "Durchmesser: " . $k1->durchmesser();
echo "<br>";

echo "Fläche: " . $k1->flaeche();
echo "<br>";

echo "Umfang: " . $k1->umfang();
echo "<br>";

// Wird in einem try-Block eine Exception geworfen, hat man mit "catch"
// eine Möglichkeit, darauf zu reagieren.
// https://www.php.net/manual/en/language.exceptions.php
try {
    $k1-> set_radius(-5);
    echo "Neuer Durchmesser: " . $k1->durchmesser();
} catch (Exception $ex) {
    // Fängt alle Exception-Objekte ab, die im try-Block geworfen wurden
    // https://www.php.net/manual/en/exception.getmessage.php
    echo "Da lief was falsch: " . $ex->getMessage();
} finally {
    // Dieser code wird in jedem Fall ausgeführt
    echo "<br> Das wars wohl.";
}

// unset() zerstört angegebene Variablen
// https://www.php.net/manual/en/language.oop5.decon.php
unset($k1);

echo "<p>Letzte Ausgabe</p>";
