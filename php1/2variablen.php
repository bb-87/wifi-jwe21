<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Variablen mit PHP</title>
  </head>

  <body>
      <h1>Variablen mit PHP</h1>

      <?php
        // Ganzzahl (integer) definieren und ausgeben
        $alter = 33;
        echo "Ich bin ";
        echo $alter;
        echo "<br>";

        // Dezimalzahl (float) definieren und ausgeben
        $kontostand = 9.81;
        echo $kontostand;
        echo "<br>";

        // Text (string) definieren und ausgeben
        $name = "Bernhard";
        echo "Ich heiße $name";
        echo "<br>";
        // Unterschied " zu '
        echo 'Ich heiße $name';
        echo "<br>";
        // Verketten mit .
        echo 'Ich heiße ' . $name;
        echo "<br>";

        // Mehrere Verkettungen
        echo 'Ich habe ' . $name . 's Stift';
        echo "<br>";
        // Alternativ
        echo "Ich habe {$name}s Stift";
        echo "<br>";

        // Boolean definieren und ausgeben
        $wahr = true;
        echo $wahr; // Ausgabe in HTML -> 1
        echo "<br>";

        $falsch = false;
        echo $falsch; // Keine Ausgabe in HTML!
        echo "<br>";

        // NULL definieren und ausgeben
        $nichts = null;
        echo $nichts; // Keine Ausgabe in HTML!
        echo "<br>";

        // Konstante definieren und ausgeben
        define("datenbank", "jwd_21");
        echo datenbank;
        echo "<br>";
        // Neue Schreibweise
        const datenbank2 = "jwd_21";
        echo datenbank2;
      ?>
  </body>
</html>
