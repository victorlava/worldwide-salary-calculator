<?php

namespace VictorLava\SalaryCalculator;

use VictorLava\SalaryCalculator;

class TaxFormatter {

    protected $taxPayer;

    public function __construct(SalaryCalculator\TaxPayer\AbstractTaxPayer $salary)
    {
        $this->taxPayer = $salary;
    }

    private function includeConfiguration()
    {
        $configuration = null;

        if($this->taxPayer->configurationServiceProvider->shouldIncludeConfiguration())
        {
            $configuration = $this->taxPayer->getConfiguration();
        }

        return $configuration;
    }

    private function cleanEmptyValues($array)
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
            "configuration" => $this->includeConfiguration(),
            "salary" => [
                "gross" => $this->taxPayer->getSalaryGross(),
                "net" => $this->taxPayer->getSalaryNet(),
                "loss" => $this->taxPayer->getSalaryLoss(),
                "lossPercentage" => $this->taxPayer->getSalaryLossPercentage()
            ]
        ]);
    }

}