<?php

class Passenger
{
    public string $name;
    public int $age;
    public string $ticketNumber;
    
    public function __construct(string $name, int $age, string $ticketNumber)
    {
        $this->name = $name;
        $this->age = $age;
        $this->ticketNumber = $ticketNumber;
    }
    
    public function introduce(): string
    {
        return "Jmenuji se {$this->name}, je mi {$this->age} let. Číslo jízdenky: {$this->ticketNumber}";
    }
}