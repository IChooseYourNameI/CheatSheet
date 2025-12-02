<?php

//třída
class Cat{
    public $barva;
    public $vaha;

    //konstruktor(chytá hodnoty při vytváření objektu)
    public function __construct($barva, $vaha){
        //vlastnosti
        $this->barva = $barva;
        $this->vaha = $vaha;
    }
}

// Instance objektu
$Tomáš = new Cat("oranžová", 4.5);
var_dump($Tomáš); // vypíše informace o objektu
echo ("<br>");
echo "Tomáš je " . $Tomáš->barva . " a váží " . $Tomáš->vaha . " kg.\n";
//metoda
$Tomáš->mňoukni = function() {
    echo "Mňau mňau!\n";
};
$Tomáš->mňoukni(); // volání metody mňoukni


?>