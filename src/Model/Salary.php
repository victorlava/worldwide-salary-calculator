<?php

namespace VictorLava\SalaryCalculator\Model;

use VictorLava\SalaryCalculator;

class Salary {

    public $gross;

    public $net;

    public $lost;

    public $lostInPercentage;

    public function set(string $propertyName, $propertyValue)
    {
        $this->{$propertyName} = $propertyValue;

        return $this->get($propertyName);
    }

    public function get(string $propertyName)
    {
        return $this->{$propertyName};
    }

//    public function gross()
//    {
//
//    }
//
//    public function net()
//    {
//
//    }
//
//    public function lost()
//    {
//
//    }
//
//    public function lostInPercentage()
//    {
//
//    }

}