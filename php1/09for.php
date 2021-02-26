<!DOCTYPE html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>for-Schleifen in PHP</title>
    </head>

    <body>
        <h1>for-Schleifen in PHP</h1>

        <?php
        // 10x10 Tabelle erstellen
        echo "<table border='1'";

        for ($row = 1; $row <= 10; $row++) {
            // Zeile 6 überspringen
            if ($row == 6) {
                continue; 
            }

            echo "<tr>";
            for ($col = 1; $col <= 10; $col++) {
                $val = $col * $row;

                // Alle durch 7 teilbaren Zahlen ausblenden
                if ($val % 7 != 0) {
                    echo "<td>{$val}</td>";
                } else {
                    echo "<td></td>";
                }
            }
            echo "</tr>";
        }

        echo "</table>";
        echo "<br>";
        ?>

        <!--
        <table border='1'>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
            </tr>
            <tr>
                <td>2</td>
                <td>4</td>
                <td>6</td>
            </tr>
            <tr>
                <td>3</td>
                <td>6</td>
                <td>9</td>
            </tr>
        </table>
        -->
    </body>
</html>