<!DOCTYPE html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Array-Funktionen in PHP</title>
    </head>

    <body>
        <h1>Array-Funktionen in PHP</h1>

        <?php
        $namen = array("Peter", "Franziska", "Mario", "Katharina", "Franziska", "Christian", "Katharina", "Florian");

        // Elemente (Werte) in Array zählen
        echo count($namen);
        echo "<br>";

        // Zufälliges Element ausgeben
        echo array_rand($namen); // Gibt zufälligen Index aus
        echo "<br>";
        $index = array_rand($namen); // Speichert zufälligen Index in Variable $index
        echo $namen[$index]; // Gibt zufälliges Element (Namen) aus
        echo "<br>";

        // Duplikate entfernen
        $namenUnique = array_unique($namen);
        echo count($namenUnique);
        echo "<br>";

        echo "<pre>";
        print_r($namenUnique);
        echo "</pre>";
        echo "<br>";

        // Prüfen ob ein Name existiert
        $name = "Katharina";

        if (in_array($name, $namen)) {
            echo "Dieser Name existiert!";
        } else {
            echo "Dieser Name existiert nicht!";
        }

        // Namen alphabetisch aufsteigend sortieren (Index bleibt unverändert)
        asort($namenUnique);
        echo "<pre>";
        print_r($namenUnique);
        echo "</pre>";
        echo "<br>";

        // Wert im Nachhinein hinzufügen
        $namenUnique[] = "Herbert";
        $namenUnique[] = "Franz"; // Ein Befehl pro zusätzlichen Wert
        array_push($namenUnique, "Julia", "Fritz"); // Ein Befehl für alle zusätzlichen Werte
        echo "<pre>";
        print_r($namenUnique);
        echo "</pre>";
        echo "<br>";

        // Namen alphabetisch aufsteigend sortieren und Index anpassen
        sort($namenUnique);
        echo "<pre>";
        print_r($namenUnique);
        echo "</pre>";
        ?>
    </body>
</html>