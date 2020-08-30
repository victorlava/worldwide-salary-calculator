<?php

namespace VictorLava\SalaryCalculator\Formatter;

use VictorLava\SalaryCalculator;

class Configuration extends AbstractFormatter {

    public function toArray()
    {
        $configuration = null;

        if($this->shouldEnableFormatter())
        {
            $configuration = $this->configurationServiceProvider->load();
        }

        return $configuration;
    }

}