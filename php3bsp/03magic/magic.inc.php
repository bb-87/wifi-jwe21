<?php
// https://www.php.net/manual/en/language.oop5.magic.php
class magic
{
    // Array speichert alle Eigenschaten über __set(), die nicht 
    // als selbstständige Eigenschaften existieren.
    private $_daten = array();

    // Wird von außen eine Eigenschaft gesetzt, die es hier im Objekt
    // nicht gibt, wird automatisch die __set()-Magic-Method verwendet.
    public function __set($variable, $wert)
    {
        $this->_daten[$variable] = $wert;
    }

    // Wird von außen eine Eigenschaft verwendet, die es hier im Objekt
    // nicht gibt, wird automatisch die __get()-Magic-Method verwendet.
    public function __get($variable)
    {
        return $this->_daten[$variable];
    }

    // Wird von außen eine Methode aufgerufen, die es hier im Objekt
    // nicht gibt, wird automatisch die __call()-Magic-Method verwendet.
    public function __call($methode, $argumente)
    {
        echo "<br>Es wurde die Methode {$methode} aufgerufen.";
        echo "<pre>";
        print_r($argumente);
        echo "<pre>";
    }

    // Wird ein komplettes Objekt mit echo ausgegeben, verwendet PHP 
    // den Rückgabewert der __toString()-Magic-Method für das echo.
    public function __toString()
    {
        return print_r($this->_daten, true);
    }
}