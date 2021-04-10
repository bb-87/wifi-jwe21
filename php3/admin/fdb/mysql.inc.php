<?php 
class fdb_mysql
{
    // Singleton Implementierung - https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
    // Vermeidet mehrfache Erstellung desselben Objektes.
    // Hier gewünscht, um nicht mehrere DB-Verbindungen gleichzeitig zu öffnen.
    private static $_instanz;

    public static function get_instanz()
    {
        if (!self::$_instanz) {
            self::$_instanz = new self(); // self() = fdb_mysql()
        }
        return self::$_instanz;
    }
    // Singleton Implementierung ENDE

    private $_db;

    private function __construct()
    {
        $this->verbinden();
    }

    public function verbinden()
    {
        // Keine neue Verbindung herstellen, wenn schon eine existiert.
        if ($this->_db) {
            return;
        }

        // Verbindung zur MySQL-DB aufbauen
        $this->_db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        // Zeichensatz mitteilen
        $this->_db->set_charset("utf8");
    }

    public function escape($wert)
    {
        // OOP: https://www.php.net/manual/en/mysqli.real-escape-string
        return $this->_db->real_escape_string($wert);
    }

    public function query($sql_befehl)
    {
        // OOP: https://www.php.net/manual/en/mysqli.query.php + https://www.php.net/manual/en/mysqli.error.php
        $return = $this->_db->query($sql_befehl) or die($this->_db->error .'<br>'.$sql_befehl);
        return $return;
    }
}