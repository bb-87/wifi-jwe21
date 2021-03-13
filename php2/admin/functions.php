<?php
// https://www.php.net/session_start
session_start();

// Verbindung zur MySQL Datenbank herstellen
// https://www.php.net/mysqli_connect
$db = mysqli_connect("localhost", "root", "", "php2_2021");

// MySQL mitteilen, dass unsere Befehle als UTF-8 kommen
// https://www.php.net/mysqli_set_charset
mysqli_set_charset($db, "utf8");

// Kurzform für mysqli_query, die auch eventuelle Fehler ausgibt
// https://www.php.net/mysqli_query + https://www.php.net/mysqli_error
function query($sql_befehl) {
    global $db;
    $result = mysqli_query($db, $sql_befehl) or die(mysqli_error($db)."<br>".$sql_befehl);
    return $result;
}

// Escape-Funktion um SQL Injections zu vermeiden
// Daten von Formularen/Benutzer ($_GET und $_POST) IMMER (!!!) mit mysqli_real_escape_string behandeln,
// bevor sie in DB-Befehlen verwendet werden.
// SQL injection verhindern: https://www.php.net/mysqli_real_escape_string
function escape($post_var) {
    global $db;
    return mysqli_real_escape_string($db, $post_var);
}

// Überprüft ob der Benutzer eingeloggt ist, ansonsten wird er automatisch zum Login weitergeleitet
function isLoggedIn() {
    if (empty($_SESSION["eingeloggt"])) {
        // Benutzer ist nicht eingeloggt -> Umleiten zum Login
        header("Location: login.php");
        exit;
    }
}