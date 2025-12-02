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

    //metoda
    public function mňaukni(){
        echo "Mňau mňau!\n";
    }
}

// Instance objektu
$Tomáš = new Cat("oranžová", 4.5);
var_dump($Tomáš); // vypíše informace o objektu
echo ("<br>");
echo "Tomáš je " . $Tomáš->barva . " a váží " . $Tomáš->vaha . " kg.\n";
echo ("<br>");

//metoda
$Tomáš->mňaukni();


?>