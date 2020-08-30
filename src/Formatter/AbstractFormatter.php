<?php

namespace VictorLava\SalaryCalculator\Formatter;

use VictorLava\SalaryCalculator;
use VictorLava\SalaryCalculator\Configuration;

class AbstractFormatter {

    protected $configurationServiceProvider;

    protected $enableFormatter = false;

    public function __construct()
    {
        $this->configurationServiceProvider = new Configuration();

        if($this->configurationServiceProvider->shouldEnableFormatter(get_class($this))) {
            $this->enableFormatter = true;
        }
    }

    public function shouldEnableFormatter() {
        return $this->enableFormatter;
    }

}