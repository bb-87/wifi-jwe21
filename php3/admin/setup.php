<?php 
// Konfiguration für das Projekt
define("MYSQL_HOST", "localhost");
define("MYSQL_USER", "root");
define("MYSQL_PASSWORD", "");
define("MYSQL_DATABASE", "php3_2021");

// Setup-Code: Nur verändern, wenn du weißt, was du tust!
session_start();

spl_autoload_register(function($klasse) {
    $pfad = str_replace("_", "/", $klasse);
    include_once $pfad.".inc.php";
});

// Überprüft ob der Benutzer eingeloggt ist, ansonsten wird er automatisch zum Login weitergeleitet.
function isLoggedIn() {
    if (empty($_SESSION["eingeloggt"])) {
        // Benutzer ist nicht eingeloggt -> Umleiten zum Login
        header("Location: login.php");
        exit;
    }
}