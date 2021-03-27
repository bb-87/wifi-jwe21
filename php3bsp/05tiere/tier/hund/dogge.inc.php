<?php 
// Vererbungen können über mehrere Ebenen gehen
class tier_hund_dogge extends tier_hund
{
    public function gib_laut()
    {
        return "Grrrrr!";
    }

    public function beissen()
    {
        return "Autsch!";
    }
}