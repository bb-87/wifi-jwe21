<?php 
class fdb_mysql
{
    private $_db;

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
}