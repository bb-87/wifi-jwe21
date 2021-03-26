<?php
// Klasse definieren, die später als Objekt verwendet werden kann
class person
{
    // Eigenschaft (en: property) festlegen: Platzhalter für spätere Werte (wie Variable)
    // Private Eigenschaften (oder auch Methoden) können nur innerhalb der Klasse angesprochen werden
    private $vorname;

    // Konstruktor: Wird automatisch aufgerufen, sobald das Objekt erzeugt wird, zB: new person();
    public function __construct($name)
    {
        $this->vorname = $name;
    }

    // Öffentliche Methode, die von außen angesprochen werden kann
    public function vorstellen()
    {
        return "Hallo, ich bin " . $this->vorname;
    }

    // Methode zum Holen des privaten Vornamens
    // Ein sogenannter "getter"
    public function get_vorname()
    {
        return $this->vorname;
    }

    // Methode zum Ändern des privaten Vornamens
    // Ein sogenannter "setter"
    public function set_vorname($name)
    {
        // Durch diese Methode haben wir die Möglichkeit, Überprüfungen vor  
        // dem Setzen des neuen Namens einzufügen
        if ($name == $this->vorname) {
            echo "<strong>So heiße ich bereits!";
        } else {
            $this->vorname = $name;
        }    
    }
}
