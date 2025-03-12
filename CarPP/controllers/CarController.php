<?php

require "models/Car.php";

class CarController {

    public function index() { 
        require "views/Car/index.view.php";
    }
}