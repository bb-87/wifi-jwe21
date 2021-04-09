<?php
abstract class fdb_model_row
{
    private $_daten = array();

    public function __construct($daten)
    {
        $this->_daten = $daten;
    }

    public function __get($eigenschaft)
    {
        return $this->_daten[$eigenschaft];
    }
}