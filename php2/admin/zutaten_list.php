<?php
include "functions.php";
isLoggedIn();

include "header.php";
?>

    <h1>Zutaten</h1>
    <p><a href="zutaten_new.php">Neue Zutat anlegen</a></p>

    <?php
    $result = query("SELECT * FROM zutaten ORDER BY titel ASC");

    echo "<table border='1'>";
    echo "<thead>
        <tr>
            <th>Titel</th>
            <th>KCal</th>
            <th>Optionen</th>
        <tr>
    </thead>
    <tbody>";
    // Nach und nach alle Ergebnis-Datensätze umwandeln. Egal wieviele.
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row["titel"]}</td>";
        echo "<td>{$row["kcal_pro_100"]}</td>";
        echo "<td>
                  <a href='zutaten_edit.php?id={$row["id"]}'>Bearbeiten</a> - 
                  <a href='zutaten_del.php?id={$row["id"]}'>Entfernen</a>
              </td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    ?>

<?php 
include "footer.php";
?>