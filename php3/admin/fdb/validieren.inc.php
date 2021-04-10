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

    /**
     * Prüfen, ob ein Wert (aus Formular) dem Schema einer FIN entspricht.
     * @param string $wert Der Wert, der auf "FIN" geprüft werden soll.
     * @param string $feldname Name des Formularfeldes für die Fehlermeldung.
     * @return bool false wenn $wert keine FIN ist, ansonsten true.
     */
    public function fin($wert, $feldname)
    {
        // https://de.wikipedia.org/wiki/Fahrzeug-Identifizierungsnummer#Aufbau_der_FIN
        if (strlen($wert) != 17) {
            $this->_errors[] = "Das Feld {$feldname} muss genau 17 Zeichen lang sein.";
            return false;
        } else if (preg_match("/[^0-9a-hj-npr-z]/i", $wert)) {
            $this->_errors[] = "Das Feld {$feldname} darf nur folgende Zeichen enthalten: 0-9 und A-Z außer IOQ.";
            return false;
        }
        return true;
    }

    /**
     * Prüfen, ob ein Wert (aus Formular) in der DB einzigartig ist.
     * @param string $tabelle Der Name der DB-Tabelle.
     * @param string $spalte Der Name der DB-Tabellen-Spalte, deren Wert einzigartig sein soll.
     * @param string $formularwert Der Wert der auf Einzigartigkeit geprüft werden soll.
     * @param int|null $id Bearbeiten-ID, wenn vorhanden, sonst null.
     * @param string $feldname Name des Formularfeldes für Fehlermeldung.
     * @return bool false wenn ein bereits verwendeter $formularwert übergeben wurde, ansonsten true.
     */
    public function eindeutig($tabelle, $spalte, $formularwert, $id, $feldname)
    {
        $db = fdb_mysql::get_instanz();
        $sql_formularwert = $db->escape($formularwert);
        $sql_id = $db->escape($id);

        $result = $db->query("SELECT * FROM {$tabelle} 
            WHERE {$spalte} = '{$sql_formularwert}' AND id != '{$sql_id}'
        ");

        if ($result->num_rows >= 1) {
            $this->_errors[] = "Der Wert im Feld {$feldname} wurde bereits verwendet, muss jedoch eindeutig sein.";
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