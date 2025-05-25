<?php

class Car {

    public $color;

    public function __construct ($color) {
        $this->color = $color;
    }
    
    public function getColor(){
        return $this->color;
    }
}

$car = new Car("red");
echo $car->getColor();