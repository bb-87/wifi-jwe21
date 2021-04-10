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

    /**
     * Gibt alle Marken alphabetisch sortiert zurück.
     * @return array Alle Marken als Array mit fdb_marke Objekten darin.
     */
    public static function get_all()
    {
        $ret = array();
        $db = fdb_mysql::get_instanz();
        $result = $db->query("SELECT * FROM marken ORDER BY titel ASC");

        while ($row = $result->fetch_assoc()) {
            $ret[] = new fdb_marke($row);
        }
        return $ret;
    }
}