<?php
include "functions.php";
isLoggedIn();

include "header.php";

echo "<h1>Zutat entfernen</h1>";
$sql_id = escape($_GET["id"]);

// Überprüfen, ob Benutzer den Bestätigungslink geklickt hat
if (!empty($_GET["del"])) {
    // Bestätigungslink wurde geklickt -> wirklich in DB löschen
    query("DELETE FROM zutaten WHERE id = '{$sql_id}'");

    echo "<p>Die Zutat wurde erfolgreich entfernt</p><br><a href='zutaten_list.php'>Zurück zur Zutatenliste</a>";
} else {
    // Benutzer fragen, ob er die Zutat wirklich entfernen will
    $result = query("SELECT * FROM zutaten WHERE id = '{$sql_id}'");
    $row = mysqli_fetch_assoc($result);

    // Prüfen, ob die Zutat einem Rezept zugeordnet ist
    $result2 = query("SELECT * FROM rezepte_zu_zutaten WHERE zutaten_id = '{$sql_id}'");
    $exists_in_recipe = mysqli_fetch_assoc($result2);



    if (!$row) {
        echo "<p>Diese Zutat existiert nicht (mehr)!</p><a href='zutaten_list.php'>Zurück zur Zutatenliste</a>";
    } else if ($exists_in_recipe) {
        echo "<p>
                Die Zutat <strong>".htmlspecialchars($row["titel"])."</strong> wird noch in einem 
                Rezept verwendet und kann daher nicht entfernt werden!
             </p>
             <a href='zutaten_list.php'>Zurück zur Zutatenliste</a>";
    } else {
        // https://www.php.net/manual/en/function.htmlspecialchars.php
        echo "<p>Sind Sie sicher, dass Sie die Zutat <strong>".htmlspecialchars($row["titel"])."</strong> entfernen möchten?</p>";
        echo "<p><a href='zutaten_list.php'>Nein, abbrechen</a> - <a href='zutaten_del.php?id={$row["id"]}&amp;del=1'>Ja, entfernen</a></p>";
    }
}

include "footer.php";