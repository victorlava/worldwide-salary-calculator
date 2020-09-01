<?php

namespace VictorLava\SalaryCalculator\Formatter;

use VictorLava\SalaryCalculator;

class Tax extends AbstractFormatter {

    public function __construct(SalaryCalculator\TaxPayer\AbstractTaxPayer $taxPayer)
    {
        $this->taxPayer = $taxPayer;
        parent::__construct();
    }

    public function toArray()
    {
        $tax = null;

        if($this->shouldEnableFormatter()) {
            $tax = [
                "income" => $this->taxPayer->tax->get('income'),
                "socialSecurity" => $this->taxPayer->tax->get('socialSecurity'),
                "sicknessSocialSecurity" => $this->taxPayer->tax->get('sicknessSocialSecurity'),
                "maternitySocialSecurity" => $this->taxPayer->tax->get('maternitySocialSecurity'),
                "pensionInsurance" => $this->taxPayer->tax->get('pensionInsurance'),
                "healthInsurance" => $this->taxPayer->tax->get('healthInsurance')
            ];
        }

        return $tax;
    }

}