<!DOCTYPE html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Arrays in PHP</title>
    </head>

    <body>
        <?php
        // Numerisches Array definieren (Index ist integer)
        $namen = array("Katharina", "Jonathan", "Julia", "Peter");
        // "Julia und Katharina" ausgeben
        echo "$namen[2] und $namen[0]";
        echo "<br>";

        // Zusätzlichen Wert im Nachhinein anhängen
        $namen[] = "Mario";
        echo $namen[4];
        echo "<br>";

        // Index als Variablen
        $x = 3;
        echo $namen[$x + 1];
        echo "<br>";

        // Array im Browser ausgeben (für Debugging-Zwecke)
        echo "<pre>";
        print_r($namen);
        echo "</pre>";


        // Assoziatives Array definieren (Index ist string)
        $person = array(
            "name" => "Max", // name = index, Max = value
            "alter" => 47, // Jeder Datentyp kann im Array enthalten sein!
            "ort" => "Salzburg"
        );
        // Ausgabe: Max (47) aus Salzburg
        echo "{$person["name"]} ({$person["alter"]}) aus {$person["ort"]}";
        echo "<br>";

        // Zusätzlichen Wert im Nachhinein anhängen
        $person["guthaben"] = 180;


        // Mehrdimensionales Array (verschachteln)
        $personen = array(
            array(
                "name" => "Herbert",
                "alter" => 33,
                "ort" => array("Heimat" => "Linz", "Ausbildung" => "Wien", "Freundschaft" => "Graz")
            ),
            array(
                "name" => "Sarah",
                "alter" => 27
            )
        );

        echo "<pre>";
        print_r($personen);
        echo "</pre>";

        // Eindimensionales, assoziatives Array im Nachhinein anhängen
        // (alternativ: $person in ursprüngliche Array Deklarierung hinzufügen)
        $personen[] = $person;

        // Sarah bekommt im Nachhinein auch einen Ort
        $personen[1]["ort"] = "Bregenz";

        echo "<pre>";
        print_r($personen);
        echo "</pre>";

        // Ausgabe: Herbert aus Linz arbeitet in Wien
        echo "{$personen[0]["name"]} aus {$personen[0]["ort"]["Heimat"]} arbeitet in {$personen[0]["ort"]["Ausbildung"]}";
        ?>
    </body>
</html>