<?php

namespace VictorLava\SalaryCalculator;

use VictorLava\SalaryCalculator\TaxPayer\AbstractTaxPayer;
use VictorLava\SalaryCalculator\TaxPayer\IndependentContractor;

class AbstractSalary {

    protected $salary; // gross

    protected $countryCode;

    protected $taxPayer;

    public function __construct(int $salary, AbstractTaxPayer $taxPayer = null, string $countryCode = null)
    {
        $this->salary = $salary;
        $this->countryCode = $countryCode;
        $this->taxPayer = $taxPayer;

        if($taxPayer === null) {
            $this->taxPayer = new IndependentContractor();
        }
    }


   public function calculate()
   {
        return $this->taxPayer->calculate($this->salary);
   }

}