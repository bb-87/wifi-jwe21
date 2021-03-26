<?php
echo "<h1>Magische Methoden</h1>";

include_once "magic.inc.php";

$obj = new magic();

// Magic method: __set()
$obj->vorname = "Markus";
$obj->vorname = "Herbert";
$obj->nachname = "Hauser";

echo "<pre>"; print_r($obj); echo "</pre>";

// Magic method: __get()
echo $obj->vorname;

// Magic method: __call()
$obj->speichern("benutzer", "insert", 5);

// Magic method: __toString()
echo $obj;