<?php
include "functions.php";
isLoggedIn();

include "header.php";
?>

    <h1>Rezepte</h1>
    <p><a href="rezepte_neu.php">Neues Rezept anlegen</a></p>

    <?php 
    // Zwei Tabellen miteinander joinen, damit nur eine DB Abfrage gemacht werden muss
    $result = query("SELECT rezepte.*, benutzer.benutzername  
        FROM rezepte JOIN benutzer ON rezepte.benutzer_id = benutzer.id 
        ORDER BY rezepte.titel ASC");

    echo "<table border='1'>";
    echo "<thead>
        <tr>
            <th>Titel</th>
            <th>Beschreibung</th>
            <th>Benutzername</th>
            <th>Optionen</th>
        <tr>
    </thead>
    <tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row["titel"]}</td>";
        echo "<td>{$row["beschreibung"]}</td>";
        echo "<td>{$row["benutzername"]}</td>";
        echo "<td>
                  <a href='rezepte_edit.php?id={$row["id"]}'>Bearbeiten</a> - 
                  <a href='rezepte_del.php?id={$row["id"]}'>Entfernen</a>
              </td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    ?>

<?php 
include "footer.php";
?>