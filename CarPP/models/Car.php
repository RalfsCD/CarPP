<?php

abstract class PropulsionSystem {
    public $power;
    public $fuelType;
    protected $efficiency;

    public function __construct($power, $fuelType, $efficiency) {
        $this->power = $power;
        $this->fuelType = $fuelType;
        $this->efficiency = $efficiency;
    }

    abstract public function work();
}

class ICEngine extends PropulsionSystem {
    public $volume;
    private $cylinderCount;

    public function __construct($power, $fuelType, $efficiency, $volume, $cylinderCount) {
        parent::__construct($power, $fuelType, $efficiency);
        $this->volume = $volume;
        $this->cylinderCount = $cylinderCount;
    }

    public function work() {
        return "Brumm brumm";
    }
}

class ElectricMotor extends PropulsionSystem {

    public function work() {
        return "Zumm, zumm";
    }
}

class Car {
    public $color;
    public $brand;
    private $releaseYear;
    private $propulsionType;
    public $propulsionSystems = [];

    public function __construct($color, $brand, $releaseYear, $propulsionType, $engineData) {
        $this->color = $color;
        $this->brand = $brand;
        $this->releaseYear = $releaseYear;
        $this->propulsionType = $propulsionType;

        if ($propulsionType == "ICE") {
            $this->propulsionSystems[] = new ICEngine($engineData['power'], $engineData['fuelType'], $engineData['efficiency'], $engineData['volume'], $engineData['cylinderCount']);
        } elseif ($propulsionType == "Electric") {
            $this->propulsionSystems[] = new ElectricMotor($engineData['power'], $engineData['fuelType'], $engineData['efficiency']);
        } elseif ($propulsionType == "Hybrid") {
            $this->propulsionSystems[] = new ICEngine($engineData['power'], $engineData['fuelType'], $engineData['efficiency'], $engineData['volume'], $engineData['cylinderCount']);
            $this->propulsionSystems[] = new ElectricMotor($engineData['power'], $engineData['fuelType'], $engineData['efficiency']);
        }
    }

    public function move() {
        echo " ";
    }

    public function makeNoise() {
        $noises = [];
        foreach ($this->propulsionSystems as $system) {
            $noises[] = $system->work();
        }
        return implode(" ", $noises);
    }
}

$engineData = [
    'power' => 150,
    'fuelType' => 'Gasoline',
    'efficiency' => 0.85,
    'volume' => 2.0,
    'cylinderCount' => 4
];

$myCar = new Car("Red", "Toyota", 2020, "Hybrid", $engineData);

echo $myCar->makeNoise();


?>
