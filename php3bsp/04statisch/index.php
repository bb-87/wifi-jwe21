<?php
echo "<h1>Statische Eigenschaften und Methoden</h1>";

include_once "statisch.inc.php";

$neu = new statisch();
$neu2 = new statisch();
$neu3 = new statisch();

echo statisch::$aufrufe;

statisch::setze_0();
echo "<br>";
echo statisch::$aufrufe;