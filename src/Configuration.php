<?php

namespace VictorLava\SalaryCalculator;

use Noodlehaus\Config;
use Noodlehaus\Parser\Json;

class Configuration {

    const DIRECTORY = 'config';

    protected $configuration;

    public function load()
    {
        $mainConfig = $this->loadMainConfiguration();
        $mainConfig['taxes'] = $this->loadCountrySpecificConfiguration($mainConfig['default_country']);

        return $mainConfig;
    }

    public function loadMainConfiguration()
    {
        return Config::load(self::DIRECTORY . '/config.json', new Json())->all();
    }

    public function loadCountrySpecificConfiguration(string $countryCode)
    {
        return Config::load(self::DIRECTORY . '/countries/' . $countryCode . '.json', new Json())->all();
    }

}