<?php
class statisch
{
    // Eine statische Eigenschaft gehört zur einmal existierenden Klasse, nicht zu 
    // einem erstellten Objekt. Dadurch bleibt die Variable über die gesamte Laufzeit bestehen.
    public static $aufrufe = 0;

    // Diese statische Methode wird auch direkt der Klasse zugeordnet. Wie die Eigenschaft
    // wird sie über self::setze_0() aufgerufen und kann nicht auf $this zugreifen - sie 
    // ist nicht Teil des Objekts.
    public static function setze_0()
    {
        self::$aufrufe = 0;
    }

    public function __construct()
    {
        self::$aufrufe++;
    }
}