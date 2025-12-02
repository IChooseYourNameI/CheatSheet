<?php

//třída
class Cat{
    public $color;
    public $weight;

    //konstruktor(chytá hodnoty při vytváření objektu)
    public function __construct($color, $weight){
        //vlastnosti
        $this->color = $color;
        $this->weight = $weight;
    }

    //metoda
    public function mňaukni(){
        echo "Mňau mňau!\n";
    }
}

// Instance objektu
$Tomáš = new Cat("oranžová", 4.5);
var_dump($Tomáš); // vypíše informace o objektu
echo ("<br>");
echo "Tomáš je " . $Tomáš->color . " a váží " . $Tomáš->weight . " kg.\n";
echo ("<br>");

//metoda
$Tomáš->mňaukni();


?>