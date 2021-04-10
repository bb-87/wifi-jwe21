<?php
abstract class fdb_model_row
{
    protected $_tabelle; // Muss in Kind-Klassen überschrieben werden
    private $_daten = array();

    public function __construct($daten)
    {
        // https://www.php.net/manual/en/function.is-numeric
        if (is_numeric($daten)) {
            $db = fdb_mysql::get_instanz();
            $sql_id = $db->escape($daten);
            $result = $db->query(
                "SELECT * FROM {$this->_tabelle} WHERE id = '{$sql_id}'"
            );
            $daten = $result->fetch_assoc();
        }

        $this->_daten = $daten;
    }

    public function __get($eigenschaft)
    {
        return $this->_daten[$eigenschaft];
    }

    public function speichern()
    {
        $db = fdb_mysql::get_instanz();

        $sql_felder = "";
        foreach ($this->_daten as $spaltenname => $formularwert) {
            if ($spaltenname == "id") {
                continue; // Spalte "id" überspringen
            }
            $sql_formularwert = $db->escape($formularwert);
            $sql_felder .= "{$spaltenname} = '{$sql_formularwert}', ";
        }

        // Letztes Komma entfernen
        $sql_felder = rtrim($sql_felder, ", ");

        if (!empty($this->_daten["id"])) {
            // In DB bearbeiten
            $sql_id = $db->escape($this->_daten["id"]);
            $db->query("UPDATE {$this->_tabelle} SET {$sql_felder} WHERE id = '{$sql_id}'");
        } else {
            // In DB einfügen
            $db->query("INSERT INTO {$this->_tabelle} SET {$sql_felder}");
        }
    }

    public function entfernen()
    {
        $db = fdb_mysql::get_instanz();
        $sql_id = $db->escape($this->id);
        $db->query("DELETE FROM {$this->_tabelle} WHERE id = '{$sql_id}'");
    }
}