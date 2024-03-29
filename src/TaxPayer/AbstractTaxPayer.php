<?php

namespace VictorLava\SalaryCalculator\TaxPayer;

use VictorLava\SalaryCalculator\Configuration;
use VictorLava\SalaryCalculator\Formatter\Base as BaseFormatter;

class AbstractTaxPayer {

    public $configurationServiceProvider;

    protected $configuration;

    protected $taxRates;

    public function __construct()
    {
        $this->configurationServiceProvider = new Configuration();
        $this->configuration = $this->configurationServiceProvider->load();
        $this->taxRates = $this->configurationServiceProvider->getTaxRates(get_class($this));
    }

    public function calculate(float $grossSalary)
    {
        $this->calculateSalary($grossSalary);

        $result = new BaseFormatter($this);

        return $result->toArray();
    }

}