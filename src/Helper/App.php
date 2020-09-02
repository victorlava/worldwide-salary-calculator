<?php


namespace VictorLava\SalaryCalculator\Helper;

use VictorLava\SalaryCalculator\Constant;
use VictorLava\SalaryCalculator\Model\Config\Config;
use VictorLava\SalaryCalculator\Helper\File;

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
            if(File::convertNameWithDashesToUppercaseFirst($key) === $name) // same key exists like the called static function
            {
                $returnValue = $configurationValue;
                break;
            }
        }

        return $returnValue;
    }

}