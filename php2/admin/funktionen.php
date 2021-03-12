<?php
// https://www.php.net/session_start
session_start();

// Verbindung zur MySQL Datenbank herstellen
// https://www.php.net/mysqli_connect
$db = mysqli_connect("localhost", "root", "", "php2_2021");

// MySQL mitteilen, dass unsere Befehle als UTF-8 kommen
// https://www.php.net/mysqli_set_charset
mysqli_set_charset($db, "utf8");


// Überprüft ob der Benutzer eingeloggt ist, ansonsten wird er automatisch zum Login weitergeleitet
function isLoggedIn() {
    if (empty($_SESSION["eingeloggt"])) {
        // Benutzer ist nicht eingeloggt -> Umleiten zum Login
        header("Location: login.php");
        exit;
    }
}