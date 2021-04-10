<?php
class fdb_fahrzeuge 
{
    private $_suche;

    public function set_suche($suchbegriff)
    {
        $this->_suche = $suchbegriff;
    }

    public function get()
    {
        $ret = array();

        $db = fdb_mysql::get_instanz();

        $sql_befehl = "SELECT * FROM fahrzeuge";
        $this->_build_where($sql_befehl);
        
        $result = $db->query($sql_befehl);

        while ($row = $result->fetch_assoc()) {
            $ret[] = new fdb_fahrzeug($row);
        }
        return $ret;
    }

    // Das "&" bedeutet, dass Variablen per Referenz übergeben werden.
    // Wenn diese in der Funktion verändert werden, wird auch die Variable, die 
    // beim Aufruf verwendet wurde ("außerhalb"), geändert.
    // https://www.php.net/manual/en/language.references.php
    private function _build_where(&$sql_befehl)
    {
        if ($this->_suche) {
            $db = fdb_mysql::get_instanz();

            $sql_suche = $db->escape($this->_suche);
            $sql_befehl .= " WHERE fin LIKE '%{$sql_suche}%' 
                OR modell LIKE '%{$sql_suche}%' 
                OR farbe LIKE '%{$sql_suche}%'";
        }
    }
}