<?php
// extends tier "kopiert" alle Eigenschaften und Methoden von der übergeordneten
// "tier" Klasse (die nicht private sind). Somit hat diese Klasse alle Möglichkeiten
// des Eltern-Objekts.
class tier_maus extends tier
{
    // Wenn eine Methode definiert wird, die mit selben Namen in der Eltern-Klasse (Tier)
    // bereits existiert, so wird diese überschrieben.
    public function get_name()
    {
        // $_name muss in "tier" protected oder public sein
        // return $this->_name . " (Maus)"; 

        // parent::get_name() ruft von der Elternklasse die Methode "get_name()"
        // auf und wir können den Rückgabewert in unserer überschriebenen Methode weiterverwenden
        $name = parent::get_name();
        return $name . " (Maus)";
    }

    public function gib_laut()
    {
        return "Fiep!";
    }
}