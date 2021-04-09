<?php 
include_once "setup.php";

// Alle $_SESSION-Variablen löschen (reicht auch alleine)
session_unset();

// Vernichtet die ganze Session samt Cookie
// Beim nächsten session_start wird wieder ganz von vorne begonnen
session_destroy();
?><!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout aus der Fahrzeug-DB</title>
</head>

<body>
    <h1>Logout aus der Fahrzeug-DB</h1>
    <p>Sie wurden erfolgreich ausgeloggt.</p>
    <p><a href="login.php">Hier geht es zurück zum Login</a></p>
</body>
</html>