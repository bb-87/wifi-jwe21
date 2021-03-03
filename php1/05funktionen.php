<!DOCTYPE html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>String-Funktionen in PHP</title>
    </head>

    <body>
        <h1>String-Funktionen in PHP</h1>

        <?php
        // String in Kleinbuchstaben umwandeln
        $text = " Herzlich Willkommen ";
        $text2 = "Österreich";
        echo ">";
        echo strtolower($text);
        echo "<";
        echo "<br>";
        echo strtolower($text2);
        echo "<br>";
        echo mb_strtolower($text2);
        echo "<br>";

        // Leerzeichen vor/nach einem Text entfernen
        echo ">";
        echo trim($text);
        echo "<";
        echo "<br>";

        // Leerzeichen und n vor/nach einen Text entfernen
        echo ">";
        echo trim($text, " n");
        echo "<";
        echo "<br>";

        // HTML Tags aus einen String entfernen
        $text = "Das ist <strong>fett</strong> und <em>kursiv</em>.";
        echo $text;
        echo "<br>";
        echo strip_tags($text);
        echo "<br>";

        // HTML Tags aus einen String entfernen (mit Ausnahmen)
        echo strip_tags($text, "<strong>");
        echo "<br>";

        // Länge eines Strings feststellen
        echo strlen($text2); // Ö -> 2 Zeichen!
        echo "<br>";
        echo mb_strlen($text2);
        echo "<br>";

        // Gibt Teil aus einem Text zurück (hier: 43)
        $text = "Ich bin 43 Jahre alt.";
        echo substr($text, 8, 2); // string, offset, length
        echo "<br>";

        // Zeilenumbrüche in <br /> umwandeln (z.B. aus Kommentar-Feld)
        $text = "Herzlich Willkommen
            am WIFI
            Salzburg";
        echo $text;
        echo "<br>";
        echo nl2br($text); // nl2br -> new line to <br />
        ?>
    </body>
</html>