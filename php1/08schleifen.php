<!DOCTYPE html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Schleifen in PHP</title>
    </head>

    <body>
        <h1>Schleifen in PHP</h1>

        <?php
        // Runtime auf 1 Sekunde limitieren um Endlos-Schleifen zu verhindern
        set_time_limit(1);


        // 1-10 mit einer while-Schleife ausgeben
        $zahl = 1;

        while ($zahl <= 10) {
            echo $zahl++;
        }
        echo "<br>";


        // do while Schleife 
        $zahl2 = 15;
        do {
            $zahl2++;
        } while ($zahl2 < 10);
        echo $zahl2; // Erwartet: 16 -> do-Schleifen laufen mindestens 1x!
        echo "<br>";


        // foreach-Schleife: Array der Reihe nach ausgeben
        $staedte = array("Bregenz", "Innsbruck", "Salzburg", "Klagenfurt", "Linz", "Graz", "St. Pölten", "Wien", "Eisenstadt");
        asort($staedte);

        foreach ($staedte as $stadt) {
            echo $stadt . " ";
        }
        echo "<br>";

        // mit Index (muss nicht $key heißen)
        foreach ($staedte as $key => $stadt) {
            echo $key . ": " . $stadt . "<br>";
        }
        ?>
    </body>
</html>