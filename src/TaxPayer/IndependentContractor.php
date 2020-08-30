<?php

namespace VictorLava\SalaryCalculator\TaxPayer;

use VictorLava\SalaryCalculator\TaxFormatter;

class IndependentContractor extends AbstractTaxPayer {
    
    public function calculateNet(float $grossSalary)
    {
        $this->setSalaryGross($grossSalary);

        $incomeTax = $grossSalary * $this->taxRates['income_tax'] / 100;

        $net = $grossSalary - $incomeTax;

        $loss = $grossSalary - $net;
        $lossPercentage = $loss * 100/$grossSalary;

        $this->setSalaryNet($net);
        $this->setSalaryLoss($loss);
        $this->setSalaryLossPercentage($lossPercentage);
    }

}