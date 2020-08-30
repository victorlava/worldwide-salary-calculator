<?php

namespace VictorLava\SalaryCalculator\TaxPayer;

use VictorLava\SalaryCalculator\TaxFormatter;

class IndependentContractor extends AbstractTaxPayer {

    public function calculateNet(float $grossSalary)
    {
        $this->setSalaryGross($grossSalary);

        $incomeTax = $this->calculateIncomeTax($grossSalary);
        $netSalary = $this->calculateNetSalary($grossSalary, $incomeTax);

        $loss = $this->calculateSalaryLoss($grossSalary, $netSalary);
        $lossPercentage = $this->calculateSalaryLossInPercetange($loss, $grossSalary);

        $this->setSalaryNet($netSalary);
        $this->setSalaryLoss($loss);
        $this->setSalaryLossPercentage($lossPercentage);
    }

    public function calculateSalaryLossInPercetange(float $salaryLost, float $grossSalary)
    {
        return $salaryLost * 100/$grossSalary;
    }

    public function calculateSalaryLoss(float $grossSalary, float $netSalary)
    {
        return $grossSalary - $netSalary;
    }

    public function calculateNetSalary(float $grossSalary, float $taxes)
    {
        return $grossSalary - $taxes;
    }

    public function calculateIncomeTax(float $grossSalary)
    {
        return $grossSalary * $this->taxRates['income_tax'] / 100;
    }

}