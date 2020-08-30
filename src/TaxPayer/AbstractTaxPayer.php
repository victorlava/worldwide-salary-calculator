<?php

namespace VictorLava\SalaryCalculator\TaxPayer;

use VictorLava\SalaryCalculator\Configuration;
use VictorLava\SalaryCalculator\TaxFormatter;

class AbstractTaxPayer {

    public $configurationServiceProvider;

    protected $configuration;

    protected $taxRates;

    protected $salaryGross = 0;

    protected $salaryNet = 0;

    protected $salaryLoss = 0;

    protected $salaryLossPercentage = 0;

    public function __construct()
    {
        $this->configurationServiceProvider = new Configuration();
        $this->configuration = $this->configurationServiceProvider->load();
        $this->taxRates = $this->configurationServiceProvider->getTaxRates(get_class($this));
    }

    public function calculate(float $grossSalary)
    {

        $this->calculateNet($grossSalary);

        $result = new TaxFormatter($this);

        return $result->toArray();
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }

    public function getTaxRates()
    {
        return $this->taxRates;
    }

    public function setSalaryLossPercentage(float $salaryLossPercentage)
    {
        $this->salaryLossPercentage = $salaryLossPercentage;
    }

    public function setSalaryLoss(float $lossSalary)
    {
        $this->salaryLoss = $lossSalary;
    }

    public function setSalaryGross(float $grossSalary)
    {
        $this->salaryGross = $grossSalary;
    }

    public function setSalaryNet(float $netSalary)
    {
        $this->salaryNet = $netSalary;
    }

    public function getSalaryLossPercentage()
    {
        return $this->salaryLossPercentage;
    }

    public function getSalaryLoss()
    {
        return $this->salaryLoss;
    }

    public function getSalaryGross()
    {
        return $this->salaryGross;
    }

    public function getSalaryNet()
    {
        return $this->salaryNet;
    }

}