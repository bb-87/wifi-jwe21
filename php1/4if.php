<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>if-Abfragen in PHP</title>
  </head>
  <body>
    <h1>if-Abfragen in PHP</h1>
    <?php
      // 0-5: Schlaf gut
      // 6-9: Guten Morgen
      // 12 oder 18: Mahlzeit
      // 19-23: Gute Nacht
      // sonst: Hallo

      // Variable für Stunde anlegen
      // date: https://www.php.net/manual/en/function.date
      $stunde = date("G");

      // if-Abfrage

      /* Erster Versuch
      if ($stunde >= 0 && $stunde <=5) {
        echo "Schlaf gut";
      } else if ($stunde >= 6 && $stunde <= 9) {
        echo "Guten Morgen";
      } else if ($stunde == 12 || $stunde == 18) {
        echo "Mahlzeit";
      } else if ($stunde >= 19 && $stunde <= 23) {
        echo "Gute Nacht";
      } else {
        echo "Hallo";
      }
      */

      // Gekürzte Version
      if ($stunde <=5) {
        echo "Schlaf gut";
      } else if ($stunde <= 9) {
        echo "Guten Morgen";
      } else if ($stunde == 12 || $stunde == 18) {
        echo "Mahlzeit";
      } else if ($stunde >= 19) {
        echo "Gute Nacht";
      } else {
        echo "Hallo";
      }
    ?>
  </body>
</html>
