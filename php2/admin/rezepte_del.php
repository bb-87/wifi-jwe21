<?php
include "functions.php";
isLoggedIn();

include "header.php";

echo "<h1>Rezept entfernen</h1>";
$sql_id = escape($_GET["id"]);

// Überprüfen, ob Benutzer den Bestätigungslink geklickt hat
if (!empty($_GET["del"])) {
    // Bestätigungslink wurde geklickt -> wirklich in DB löschen
    query("DELETE FROM rezepte WHERE id = '{$sql_id}'");

    echo "<p>Das Rezept wurde erfolgreich entfernt</p><br><a href='rezepte_list.php'>Zurück zur Rezeptliste</a>";
} else {
    // Benutzer fragen, ob er das Rezept wirklich entfernen will
    $result = query("SELECT * FROM rezepte WHERE id = '{$sql_id}'");
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "<p>Dieses Rezept existiert nicht (mehr)!</p><a href='rezepte_list.php'>Zurück zur Rezeptliste</a>";
    } else {
        // https://www.php.net/manual/en/function.htmlspecialchars.php
        echo "<p>Sind Sie sicher, dass Sie das Rezept <strong>".htmlspecialchars($row["titel"])."</strong> entfernen möchten?</p>";
        echo "<p><a href='rezepte_list.php'>Nein, abbrechen</a> - <a href='rezepte_del.php?id={$row["id"]}&amp;del=1'>Ja, entfernen</a></p>";
    }
}

include "footer.php";