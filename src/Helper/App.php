<?php


namespace VictorLava\SalaryCalculator\Helper;

use VictorLava\SalaryCalculator\Constant;
use VictorLava\SalaryCalculator\Model\Config\Config;
use VictorLava\SalaryCalculator\Helper\Path;


class App {

    public static function get()
    {
        $config = new Config();
        return $config; // Refactor this
    }

    public static function __callStatic($name, $arguments)
    {
        $returnValue = null;
        $configurationValues = self::get();

        foreach ($configurationValues as $key => $configurationValue)
        {
            if(Path::convertDashesToUppercaseFirst($key) === $name) // same key exists like the called static function
            {
                $returnValue = $configurationValue;
                break;
            }
        }

        return $returnValue;
    }

}