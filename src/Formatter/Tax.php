<?php

namespace VictorLava\SalaryCalculator\Formatter;

use VictorLava\SalaryCalculator;

class Tax extends AbstractFormatter {

    public function toArray()
    {
        $tax = null;

        if($this->shouldEnableFormatter()) {
            $tax = [
                "incomeTax" => ''
            ];
        }

        return $tax;
    }

}