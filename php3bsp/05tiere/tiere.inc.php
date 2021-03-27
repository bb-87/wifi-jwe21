<?php 
class tiere implements interface_tiere, Iterator
{
    private $_herde = array();

    // Typdeklaration (type-hint): tier
    // Nur Objekte, die von "tier" erben, oder selbst "tier" sind,
    // dürfen als Argument an diese Methode übergeben werden.
    public function add(tier $tier)
    {
        $this->_herde[] = $tier;
    }

    public function ausgabe()
    {
        $ret = "";
        foreach ($this->_herde as $tier) {
            $ret .= $tier->get_name();
            $ret .= " macht ";
            $ret .= $tier->gib_laut();
            $ret .= "<br>";
        }
        return $ret;
    }

    // Iterator-Interface Implementation
    // https://www.php.net/manual/en/class.iterator.php
    private $_position = 0; // Index für unser numerisches $_herde Array

    // Return current element
    public function current()
    {
        return $this->_herde[$this->_position];
    }

    // Return key of current element
    public function key()
    {
        return $this->_position;
    }

    // Move to next element
    public function next()
    {
        $this->_position++;
    }

    // Set/rewind iterator at the beginning to first element
    public function rewind()
    {
        $this->_position = 0;
    }

    // Check if current postion is valid (returns true/false)
    public function valid()
    {
        // https://www.php.net/isset
        return isset($this->_herde[$this->_position]);
    }
}