<?php 
$passwort = "wifi";
$db_passwort = "5f27dde10bfa8adadfd122521b0a01ef";

echo md5($passwort);
echo "<br>";

if (md5($passwort) == $db_passwort) {
    echo "Passwort ist richtig";
}
echo "<br>";
// md5, sha1, ... ist nicht für Passwörter gedacht -> unsicher!


$salt = "jsdlkSDLKJjals29JS&lkas";

echo md5($passwort.$salt);
echo "<br>";
// Salt = sicherer, wenn aber code compromised ist -> unsicher! ($salt für Angreifer sichtbar)
// https://de.wikipedia.org/wiki/Salt_(Kryptologie)


echo password_hash($passwort, PASSWORD_DEFAULT);
// Besser: https://www.php.net/password_hash + https://www.php.net/password_verify




// P.S. Schließender PHP-Tag soll weggelassen werden, wenn im Dokument ausschließlich PHP verwendet wird