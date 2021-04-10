<?php
include "setup.php";
isLoggedIn();

include "header.php";

echo "<h1>Fahrzeuge</h1>";

echo "<a href='fahrzeuge_edit.php'>Neues Fahrzeug anlegen</a>";

// Suchformular
echo 
    "<form action='fahrzeuge_list.php' method='GET'>
        <input 
            type='text' 
            name='suche' 
            placeholder='Suche: Modell, Farbe, FIN,...'
            value='";
            if (!empty($_GET["suche"])) {
                echo htmlspecialchars($_GET["suche"]);
            }
            echo "';
        >
        <button type='submit'>Suchen</button>
    </form>";

echo 
    "<table>
        <thead>
            <tr>
                <th>Marke</th>
                <th>Modell</th>
                <th>Farbe</th>
                <th>Fahrzeug-Identifikations-Nr.</th>
                <th>Optionen</th>
            </tr>
        </thead>
    <tbody>";

$fahrzeuge = new fdb_fahrzeuge();

if (!empty($_GET["suche"])) {
    $fahrzeuge->set_suche($_GET["suche"]);
}

foreach ($fahrzeuge->get() as $fahrzeug) {
    echo "<tr>";
    echo "<td>{$fahrzeug->marke()->titel}</td>";
    echo "<td>{$fahrzeug->modell}</td>";
    echo "<td>{$fahrzeug->farbe}</td>";
    echo "<td>{$fahrzeug->fin}</td>";
    echo 
        "<td>
            <a href='fahrzeuge_edit.php?id={$fahrzeug->id}'>Bearbeiten</a> - 
            <a href='fahrzeuge_del.php?id={$fahrzeug->id}'>Entfernen</a>
        </td>";
    echo "</tr>";
}

echo "</tbody>
</table>";

include "footer.php";
?>