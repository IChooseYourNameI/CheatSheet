<?php

class Classroom {
    public $nazevTridy;
    public $mistnost;
    public $kapacita;
    
    public $zaci = [];

    public function __construct($nazevTridy, $mistnost, $kapacita) {
        $this->nazevTridy = $nazevTridy;
        $this->mistnost = $mistnost;
        $this->kapacita = $kapacita;
    }

    public function zapisZaka($zak) {
        if (count($this->zaci) < $this->kapacita) {
            $this->zaci[] = $zak;
            echo "<p>{$zak->jmeno} byl/a zapsán/a do třídy {$this->nazevTridy}.</p>";
        } else {
            echo "<p>Třída {$this->nazevTridy} je plná! {$zak->jmeno} se nemůže zapsat.</p>";
        }
    }

    public function vypisTridu() {
        echo "<h2>Třída: {$this->nazevTridy} (místnost {$this->mistnost}, kapacita {$this->kapacita})</h2>";
        echo "<p>Aktuální počet žáků: " . count($this->zaci) . "</p>";
        echo "<ul>";
        foreach ($this->zaci as $zak) {
            echo "<li>{$zak->jmeno} ({$zak->vek} let, číslo žáka: {$zak->cisloZaka})</li>";
        }
        echo "</ul>";
    }
}

?>