<?php

class ElectricCar extends Car
{
    public int $batteryLevel;
    public float $rangeLeft;
    
    public function __construct(
        string $brand, 
        string $color, 
        int $maxPassengers = 5,
        int $initialBattery = 100,
        float $initialRange = 420.0
    ) {
        parent::__construct($brand, $color, $maxPassengers);
        
        $this->batteryLevel = $initialBattery;
        $this->rangeLeft = $initialRange;
    }
    
    public function charge(int $percent): void
    {
        $this->batteryLevel = min(100, $this->batteryLevel + $percent);
        $this->rangeLeft = $this->batteryLevel * 4.2;
        
        echo "Nabíjím {$this->brand}... Aktuální stav baterie: {$this->batteryLevel}%\n";
    }
    
    public function drive(int $km): void
    {
        if ($this->rangeLeft < $km) {
            echo "Nedostatek dojezdu! Zůstalo jen {$this->rangeLeft} km.\n";
            return;
        }
        
        $this->rangeLeft -= $km;
        $this->batteryLevel = max(0, round($this->rangeLeft / 4.2));
        
        echo "Jedu {$km} km... Zbývá dojezd: {$this->rangeLeft} km ({$this->batteryLevel}%)\n";
    }

    public function showPassengers(): void
    {
        parent::showPassengers();
        echo "  Stav baterie: {$this->batteryLevel}% | Dojezd: {$this->rangeLeft} km\n";
    }
}