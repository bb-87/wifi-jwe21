<?php
class kreis
{
    // Konstante, die fix einer Klasse zugeordnet ist
    const pi = 3.1415926535898;

    // Underscore in Variablennamen deutet auf geschützte Variable hin
    private $_radius;

    // https://www.php.net/manual/en/language.oop5.decon.php
    public function __construct($rad)
    {
        $this->set_radius($rad);
    }

    // Wird ein Objekt gelöscht - mit unset() oder von PHP beim finalen Aufräumen
    // wenn das Skript zu Ende ist - dann wir der Destruktor automatisch aufgerufen
    public function __destruct()
    {
        echo "<p> Kreis mit Radius ".$this->_radius." wurde zerstört.";
    }

    public function durchmesser()
    {
        return $this->_radius * 2;
    }

    public function flaeche()
    {
        // https://www.php.net/manual/en/language.oop5.paamayim-nekudotayim.php
        return pow($this->_radius, 2) * self::pi; 
        // return $this->_radius ** 2 * self::pi;
    }

    /**
     * Berechnet anhand des gegebenen Radius den Umfang des Kreises. 
     * @return float Der berechnete Umfang des Kreises.
     */
    public function umfang()
    {
        return $this->durchmesser() * self::pi;
    }

    /**
     * Setzt einen neuen Radius für den Kreis.
     * Auch wenn der Kreis bereits existiert und mit einem Radius im Konstruktor
     * befüllt wurde, kann man so einen Neuen setzen.
     * @param int $neuer_radius Der neue Radius, der gesetzt werden soll.
     * @return void
     * @throws Exception
     */
    public function set_radius($neuer_radius) 
    {
        if ($neuer_radius <= 0) {
            // Wirft eine exception, die als Fehler am Bildschirm aufscheint.
            // https://www.php.net/manual/en/class.exception.php
            throw new Exception("Der Radius vom Kreis muss größer 0 sein.");
        }
        $this->_radius = $neuer_radius;
    }
}
