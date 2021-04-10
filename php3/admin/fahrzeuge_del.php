<?php
include "setup.php";
isLoggedIn();

include "header.php";

echo "<h1>Fahrzeug entfernen</h1>";
$fahrzeug = new fdb_fahrzeug($_GET["id"]);

if (!empty($_GET["del"])) {
    // Bestätigungslink wurde geklickt -> wirklich löschen
    $fahrzeug->entfernen();

    echo "<p>Das Fahrzeug wurde erfolgreich entfernt</p><br><a href='fahrzeuge_list.php'>Zurück zur Liste</a>";
} else {
    // Fragen, ob das Fahrzeug wirklich gelöscht werden soll
    echo "<h3>Möchten Sie dieses Fahrzeug wirklich entfernen?</h3>";
    echo "<strong>Marke:</strong> {$fahrzeug->marke()->titel}<br>";
    echo "<strong>Modell:</strong> {$fahrzeug->modell}<br>";
    echo "<strong>Farbe:</strong> {$fahrzeug->farbe}<br>";
    echo "<strong>FIN:</strong> {$fahrzeug->fin}<br>";

    echo "<a href='fahrzeuge_list.php'>Nein, abbrechen</a> - ";
    echo "<a href='fahrzeuge_del.php?id={$fahrzeug->id}&amp;del=1'>Ja, löschen</a>";
}

include "footer.php";
?>