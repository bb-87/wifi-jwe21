<?php
include_once "setup.php";

if (!empty($_POST)) {
    // Validierung
    $validieren = new fdb_validieren();
    $validieren->ist_ausgefuellt($_POST["benutzername"], "Benutzername");
    $validieren->ist_ausgefuellt($_POST["passwort"], "Passwort");

    // Wenn keine Fehler auftreten -> DB nach Benutzer fragen
    if ($validieren->keine_fehler()) {
        $db = fdb_mysql::get_instanz();

        $sql_benutzername = $db->escape($_POST["benutzername"]);

        $result = $db->query("SELECT * FROM benutzer WHERE benutzername = '{$sql_benutzername}'");
        $benutzer = $result->fetch_assoc();

        // https://www.php.net/manual/en/function.password-verify
        if (empty($benutzer) || !password_verify($_POST["passwort"], $benutzer["passwort"])) {
            // Fehler, Benutzer existiert nicht oder Passwort war falsch
            $validieren->add_error("Benutzername oder Passwort war falsch.");
        } else {
            // Benutzer existiert -> Login in Session merken
            $_SESSION["eingeloggt"] = true;
            $_SESSION["benutzername"] = $benutzer["benutzername"];
            $_SESSION["benutzer_id"] = $benutzer["id"];

            // Umleitung ins Admin-System
            header("Location: index.php");
            exit;
        }
    }
}
?><!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginbereich zur Fahrzeug-DB</title>
</head>

<body>
    <h1>Loginbereich zur Fahrzeug-DB</h1>

    <?php 
    // Fehlermeldung ausgeben, wenn eine aufgetreten ist
    if (!empty($validieren)) {
        echo $validieren->fehler_html();
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