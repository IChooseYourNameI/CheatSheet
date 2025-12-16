<?php

class Student {
    public $jmeno;
    public $vek;
    public $cisloZaka;

    public function __construct($jmeno, $vek, $cisloZaka) {
        $this->jmeno = $jmeno;
        $this->vek = $vek;
        $this->cisloZaka = $cisloZaka;
    }

    public function predstavSe() {
        echo "<p>Ahoj, jmenuji se {$this->jmeno}, je mi {$this->vek} let a moje číslo žáka je {$this->cisloZaka}.</p>";
    }
}

?>