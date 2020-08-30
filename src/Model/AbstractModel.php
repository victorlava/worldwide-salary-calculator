<?php

namespace VictorLava\SalaryCalculator\Model;

use VictorLava\SalaryCalculator;

class AbstractModel {

    public function set(string $propertyName, $propertyValue)
    {
        $this->{$propertyName} = $propertyValue;

        return $this->get($propertyName);
    }

    public function get(string $propertyName)
    {
        return $this->{$propertyName};
    }

}