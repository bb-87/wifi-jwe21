<?php
class fdb_fahrzeuge 
{
    public function get()
    {
        $ret = array();

        $db = fdb_mysql::get_instanz();
        $result = $db->query("SELECT * FROM fahrzeuge");

        while ($row = $result->fetch_assoc()) {
            $ret[] = new fdb_fahrzeug($row);
        }
        return $ret;
    }
}