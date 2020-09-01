<?php


namespace VictorLava\SalaryCalculator\Helper;

use VictorLava\SalaryCalculator\Constant;
use VictorLava\SalaryCalculator\Model\Config\Config;
use VictorLava\SalaryCalculator\Helper\File;

class App {

    public static function getConfiguration()
    {
        $config = new Config();
        return $config->configuration; // Refactore this
    }

    public static function __callStatic($name, $arguments)
    {
        $returnValue = null;
        $configurationValues = self::getConfiguration();

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