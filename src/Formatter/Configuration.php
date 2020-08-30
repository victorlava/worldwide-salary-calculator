<?php

namespace VictorLava\SalaryCalculator\Formatter;

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