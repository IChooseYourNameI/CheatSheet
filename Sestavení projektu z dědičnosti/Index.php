<?php

require_once 'Passenger.php';
require_once 'Car.php';
require_once 'ElectricCar.php';

echo "=== TESTOVÁNÍ AUTA A CESTUJÍCÍCH ===\n\n";

$skoda = new Car("Škoda Octavia", "tmavě modrá", 5);

$jan = new Passenger("Jan Novák", 34, "A12-456");
$eva = new Passenger("Eva Svobodová", 28, "A12-789");
$petr = new Passenger("Petr Černý", 45, "A12-101");
$maria = new Passenger("Marie Kovářová", 19, "A12-202");

$skoda->boardPassenger($jan);
$skoda->boardPassenger($eva);
$skoda->boardPassenger($petr);
$skoda->boardPassenger($maria);

echo "\n";
$skoda->showPassengers();

echo "\nPočet cestujících: " . $skoda->getPassengerCount() . " / " . $skoda->maxPassengers . "\n\n";

$tesla = new ElectricCar("Tesla Model Y", "bílá perleť", 5, 87, 365);

$tesla->boardPassenger($jan);
$tesla->boardPassenger($eva);

echo "\n";
$tesla->showPassengers();

echo "\n--- Jízda a nabíjení ---\n";
$tesla->drive(120);
$tesla->drive(180);
$tesla->drive(100);
$tesla->charge(60);
$tesla->drive(80);

echo "\nKonec ukázky.\n";