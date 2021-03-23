<?php
include "functions.php";

// Wurde das Formular abgeschickt?
if (!empty($_POST)) {
    // Validierung
    if (empty($_POST["benutzername"]) || empty($_POST["passwort"])) {
        $error = "Benutzername oder Passwort war leer.";
    } else {
        // Benutzer und Passwort wurden übergeben

        // SQL injection verhindern
        $sql_benutzername = escape($_POST["benutzername"]);

        // DB fragen, ob der eingegebene Benutzer existiert
        $result = query("SELECT * FROM benutzer WHERE benutzername = '{$sql_benutzername}'");

        // Einen Datensatz aus MySQL in ein PHP-Array umwandeln
        // https://www.php.net/mysqli_fetch_assoc - numerisches Array: https://www.php.net/mysqli_fetch_row
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Benutzer existiert -> Passwort prüfen
            // password_verify überprüft, ob ein eingegebenes Passwort mit einem zuvor
            // mit password_hash verschlüsselten Passwort übereinstimmt.
            if (password_verify($_POST["passwort"], $row["passwort"])) {
                // Passwort ist auch korrekt -> login merken -> cookie setzen mit:
                $_SESSION["eingeloggt"] = true;
                $_SESSION["benutzername"] = $row["benutzername"];
                $_SESSION["benutzer_id"] = $row["id"];

                // Letztes Login & Anzahl der Logins in DB speichern
                query("UPDATE benutzer SET letztes_login = NOW(), anzahl_logins = anzahl_logins + 1 WHERE id = '{$row["id"]}'");

                // Umleitung ins Admin-System
                // https://www.php.net/manual/en/function.header.php
                header("Location: index.php");
                exit; // nachfolgender code wird nicht mehr ausgeführt
            } else {
                // Passwort ist falsch -> Fehlermeldung
                $error = "Benutzername oder Passwort war falsch.";
            }
        } else {
            // Benutzer ist nicht in DB -> Fehlermeldung
            $error = "Benutzername oder Passwort war falsch.";
        }
    }
}
?><!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginbereich zur Rezepteverwaltung</title>
</head>

<body>
    <h1>Loginbereich zur Rezepteverwaltung</h1>

    <?php 
    // Fehlermeldung ausgeben, wenn eine aufgetreten ist
    if (!empty($error)) {
        echo "<p>{$error}</p>";
    }
    ?>

    <form action="login.php" method="POST">
        <div>
            <label for="benutzername">Benutzername</label>
            <input type="text" name="benutzername" id="benutzername">
        </div>

        <div>
            <label for="passwort">Passwort</label>
            <input type="password" name="passwort" id="passwort">
        </div>

        <div>
            <button type="submit">Einloggen</button>
        </div>
    </form>
</body>
</html>