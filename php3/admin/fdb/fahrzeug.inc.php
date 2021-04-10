<?php
class fdb_fahrzeug extends fdb_model_row
{
    protected $_tabelle = "fahrzeuge";

    /**
     * Gibt die Infos zu der Marke des Fahrzeugs zurück.
     * @return fdb_marke Ein Objekt, das die komplette zugeordnete Marke repräsentiert.
     */
    public function marke()
    {
        return fdb_marken::get_by_id($this->marken_id);
    }
}