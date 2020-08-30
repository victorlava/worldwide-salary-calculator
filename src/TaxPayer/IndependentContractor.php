<?php

namespace VictorLava\SalaryCalculator\TaxPayer;

use VictorLava\SalaryCalculator\Model\Salary;

class IndependentContractor extends AbstractTaxPayer {

    public function __construct()
    {
        $this->salary = new Salary();
        parent::__construct();
    }

    public function calculateNet(float $grossSalary)
    {
        $incomeTax = $this->calculateIncomeTax($grossSalary);

        $this->salary->set('gross', $grossSalary);
        $this->salary->set('net', $this->calculateSalaryNet($incomeTax));
        $this->salary->set('lost', $this->calculateSalaryLost());
        $this->salary->set('lostInPercentage', $this->calculateSalaryLostInPercetange());

    }

    public function calculateSalaryLostInPercetange()
    {
        return $this->salary->get('lost') * 100 / $this->salary->get('gross');
    }

    public function calculateSalaryLost()
    {
        return $this->salary->get('gross') - $this->salary->get('net');
    }

    public function calculateSalaryNet(float $taxes)
    {
        return $this->salary->get('gross') - $taxes;
    }

    public function calculateIncomeTax(float $grossSalary)
    {
        return $grossSalary * $this->taxRates['income_tax'] / 100;
    }

}