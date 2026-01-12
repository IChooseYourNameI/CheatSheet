<?php

class Car
{
    public string $brand;
    public string $color;
    public int $maxPassengers;
    
    /** @var Passenger[] */
    public array $passengers = [];
    
    public function __construct(string $brand, string $color, int $maxPassengers = 5)
    {
        $this->brand = $brand;
        $this->color = $color;
        $this->maxPassengers = $maxPassengers;
    }
    
    public function boardPassenger(Passenger $passenger): bool
    {
        if (count($this->passengers) >= $this->maxPassengers) {
            echo "Auto je plné! {$passenger->name} nemůže nastoupit.\n";
            return false;
        }
        
        $this->passengers[] = $passenger;
        echo "{$passenger->name} nastoupil(a) do {$this->brand}.\n";
        return true;
    }
    
    public function getPassengerCount(): int
    {
        return count($this->passengers);
    }
    
    public function showPassengers(): void
    {
        if (empty($this->passengers)) {
            echo "V autě nikdo nesedí.\n";
            return;
        }
        
        echo "V {$this->brand} ({$this->color}) aktuálně sedí:\n";
        foreach ($this->passengers as $p) {
            echo "  • " . $p->introduce() . "\n";
        }
    }
}