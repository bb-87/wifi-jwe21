<!DOCTYPE html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>regex in PHP</title>
    </head>

    <body>
        <h1>regex (Regular Expressions) in PHP</h1>

        <?php
        // Benutzernamen auf gültige Zeichen prüfen
        // Erlaubt: a-z 0-9 und Punkt
        $username = "christian.09";

        if (!preg_match("/[^0-9a-z\.]/", $username)) {
            echo "Der Benutzername ist gültig.";
        } else {
            echo "Der Benutzername ist unzulässig. Bitte verwenden Sie nur 0-9, a-z und Punkte.";
        }
        ?>
    </body>
</html>