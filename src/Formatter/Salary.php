<?php

namespace VictorLava\SalaryCalculator\Formatter;

use VictorLava\SalaryCalculator;

class Salary extends AbstractFormatter {

    public function __construct(SalaryCalculator\TaxPayer\AbstractTaxPayer $taxPayer)
    {
        $this->taxPayer = $taxPayer;
        parent::__construct();
    }

    public function toArray()
    {
        $salary = null;

        if($this->shouldEnableFormatter()) {
            $salary = [
                "gross" => $this->taxPayer->salary->get('gross'),
                "net" => $this->taxPayer->salary->get('net'),
                "lost" => $this->taxPayer->salary->get('lost'),
                "lostInPercentage" => $this->taxPayer->salary->get('lostInPercentage')
            ];
        }

       return $salary;
    }

}