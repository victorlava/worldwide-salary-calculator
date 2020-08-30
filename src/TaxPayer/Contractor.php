<?php

namespace VictorLava\SalaryCalculator\TaxPayer;

use VictorLava\SalaryCalculator\Model\Salary;
use VictorLava\SalaryCalculator\Model\Tax;

class Contractor extends AbstractTaxPayer {

    public function __construct()
    {
        $this->salary = new Salary();
        $this->tax = new Tax();

        parent::__construct();
    }

    public function calculateSalary(float $grossSalary)
    {
        $this->salary->set('gross', $grossSalary);

        $this->calculateTaxes();

        $this->salary->set('net', $this->calculateSalaryNet());
        $this->salary->set('lost', $this->calculateSalaryLost());
        $this->salary->set('lostInPercentage', $this->calculateSalaryLostInPercetange());

    }

    public function calculateTaxes()
    {
        $this->tax->set('income', $this->calculateIncomeTax());

    }

    public function calculateSalaryLostInPercetange()
    {
        return $this->salary->get('lost') * 100 / $this->salary->get('gross');
    }

    public function calculateSalaryLost()
    {
        return $this->salary->get('gross') - $this->salary->get('net');
    }

    public function calculateSalaryNet()
    {
        return $this->salary->get('gross') - $this->tax->get('income');
    }

    public function calculateIncomeTax()
    {
        $gross = $this->salary->get('gross');
        $expenses = $this->salary->get('expenses');

        return ($gross - $expenses) * $this->taxRates['income_tax'] / 100;
    }

}