<?php 
// abstract vor Klasse heißt: 
// Diese Klasse muss "extended" werden. Sie kann nicht selbst als Objekt erstellt werden.
abstract class tier
{
    // Sichtbarkeits-Modifikatoren:
    // public: Kann von "außen" (z.B. index.php) gelesen und bearbeitet werden
    // protected: Diese Klasse und Kind-Klassen können die Eigenschaft verwenden
    // private: Ausschließlich diese Klasse kann die Eigenschaft verwenden
    private $_name;

    public function __construct($name)
    {
        $this->_name = $name;
    }

    // public final function get_name()
    // Wenn etwas "final" ist, kann keine Kind-Klasse diese Methode überschreiben.
    public function get_name()
    {
        return $this->_name;
    }

    // abstract vor Methode heißt: 
    // Diese Methode muss in Kind-Klassen überschrieben werden.
    abstract public function gib_laut();
}