<?php
include "setup.php";
isLoggedIn();

include "header.php";

echo "<h1>Fahrzeuge</h1>";

echo "<table>
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

// echo "<pre>";
// print_r($fahrzeuge->get());
// echo "</pre>";
// exit;

foreach ($fahrzeuge->get() as $fahrzeug) {
    echo "<tr>";
    echo "<td>{$fahrzeug->marke()->titel}</td>";
    echo "<td>{$fahrzeug->modell}</td>";
    echo "<td>{$fahrzeug->farbe}</td>";
    echo "<td>{$fahrzeug->fin}</td>";
    echo "<td>-</td>";
    echo "</tr>";
}

echo "</tbody>
</table>";

include "footer.php";
?>