<!DOCTYPE html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Eigene Funktionen in PHP</title>
    </head>

    <body>
        <h1>Eigene Funktionen in PHP</h1>

        <?php
        // Grad Celsius in Grad Fahrenheit umrechnen
        // Formel: °F = °C * 1.8 + 32
        function convertCtoF($degreeC)
        {
            $degreeF = $degreeC * 1.8 + 32;
            return $degreeF;
        }

        echo convertCtoF(30);
        echo "<br>";

        // Datum formatieren, 2021-02-20 -> 20.02.2021
        $datum_mysql = "2021-02-20";

        function datum_de($datum_falsch)
        {
            $tag = substr($datum_falsch, 8, 2);
            $monat = substr($datum_falsch, 5, 2);
            $jahr = substr($datum_falsch, 0, 4);
            $datum_de = "{$tag}.{$monat}.{$jahr}";
            return $datum_de;
        }

        echo datum_de($datum_mysql);
        echo "<br>";

        // Datum formatieren: 2. Variante
        // https://www.php.net/manual/en/function.explode
        function datum_de2($datum_falsch)
        {
            $array = explode("-", $datum_falsch);
            return "{$array[2]}.{$array[1]}.{$array[0]}";
        }

        echo datum_de2($datum_mysql);
        echo "<br>";

        // Datum formatieren: 3. Variante (unterstützt auch andere Schreibweisen, z.B. 02/20/2021)
        // https://www.php.net/manual/en/function.strtotime.php
        function datum_de3($datum_falsch)
        {
            $time = strtotime($datum_falsch);
            return date("d.m.Y", $time); // https://www.php.net/manual/en/datetime.format.php
        }

        echo datum_de3($datum_mysql);
        echo "<br>";

        // Zeichenkette nach 10 Zeichen abschneiden und ... anhängen
        $text = "Dies ist ein langer Text der 10 Zeichen überschreitet.";

        function text_abschneiden($txt)
        {
            if (mb_strlen($txt) > 10) {
                $shrt_txt = mb_substr($txt, 0, 10);
                return "{$shrt_txt}...";
            } else {
                return $txt;
            }
        }

        echo text_abschneiden($text);
        echo "<br>";

        // 2. Variante: Zeichenkette nach ? Zeichen abschneiden und ... anhängen
        $text = "Dies ist ein langer Text der ? Zeichen überschreitet.";

        function text_abschneiden2($txt, $length)
        {
            if (mb_strlen($txt) > $length) {
                $shrt_txt = mb_substr($txt, 0, $length);
                return "{$shrt_txt}...";
            } else {
                return $txt;
            }
        }

        echo text_abschneiden2($text, 15);
        ?>
    </body>
</html>