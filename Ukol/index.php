<?php

include 'classroom.php';
include 'student.php';

echo "<h1>Scénář: Žáci se zapisují do třídy</h1>";

$trida1 = new Classroom("3.A", "Budova B", 30);

$zak1 = new Student("Jan Novák", 15, "123456");
$zak2 = new Student("Petra Svobodová", 16, "654321");
$zak3 = new Student("Tomáš Kovář", 15, "987654");

$trida1->zapisZaka($zak1);
$trida1->zapisZaka($zak2);
$trida1->zapisZaka($zak3);

$trida1->vypisTridu();

echo "<hr>";

$zak1->predstavSe();

?>