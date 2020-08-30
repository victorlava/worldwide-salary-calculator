<?php

namespace VictorLava\SalaryCalculator\Formatter;

use VictorLava\SalaryCalculator;
use VictorLava\SalaryCalculator\Formatter\Configuration as ConfigurationFormatter;
use VictorLava\SalaryCalculator\Formatter\Salary as SalaryFormatter;
use VictorLava\SalaryCalculator\Formatter\Tax as TaxFormatter;

class Base {

    protected $taxPayer;

    public function __construct(SalaryCalculator\TaxPayer\AbstractTaxPayer $taxPayer)
    {
        $this->configuration = new ConfigurationFormatter();
        $this->salary = new SalaryFormatter($taxPayer);
        $this->tax = new TaxFormatter($taxPayer);
    }

    public function cleanEmptyValues($array)
    {
        foreach($array as $key => $value)
        {
            if($value === null) {
                unset($array[$key]);
            }
        }

        return $array;
    }

    public function toArray()
    {
        return $this->cleanEmptyValues([
            "configuration" => $this->configuration->toArray(),
            "salary" => $this->salary->toArray(),
            "tax" => $this->tax->toArray()
        ]);
    }

}