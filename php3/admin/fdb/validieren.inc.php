<?php 
class fdb_validieren
{
    private $_errors = array(); 

    /**
     * Prüfen, ob ein Wert (aus Formular) ausgefüllt ist.
     * @param string $wert Der Wert, der auf "ausgefüllt" geprüft werden soll.
     * @param string $feldname Name des Formularfeldes für die Fehlermeldung.
     * @return bool false wenn $wert leer ist, ansonsten true.
     */
    public function ist_ausgefuellt($wert, $feldname)
    {
        if (empty($wert)) {
            $this->_errors[] = "Bitte füllen Sie das Feld {$feldname} aus.";
            return false;
        }
        return true;
    }

    public function add_error($fehlermeldung)
    {
        $this->_errors[] = $fehlermeldung;
    }

    public function fehler_html()
    {
        if ($this->keine_fehler()) {
            return "";
        } else {
            $ret = '<ul class="fdb-validieren-error">';

            foreach ($this->_errors as $error) {
                $ret .= "<li>{$error}</li>";
            }

            $ret .= "</ul>";
            return $ret; 
        }
    }

    public function keine_fehler()
    {
        return empty($this->_errors);
    }
}