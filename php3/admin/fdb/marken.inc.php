<?php
class fdb_marken
{
    public static function get_by_id($marke_id)
    {
        $db = fdb_mysql::get_instanz();
        $sql_marke_id = $db->escape($marke_id);
        $result = $db->query("SELECT * FROM marken WHERE id = '{$sql_marke_id}'");
        $row = $result->fetch_assoc();
        return new fdb_marke($row);
    }
}