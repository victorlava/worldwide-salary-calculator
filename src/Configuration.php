<?php

namespace VictorLava\SalaryCalculator;

use Noodlehaus\Config;
use Noodlehaus\Parser\Json;

class Configuration {

    const CONFIG_DIRECTORY = 'config';

    const COUNTRY_DIRECTORY = self::CONFIG_DIRECTORY . '/rates/';

    const CONFIG_FILE_TYPE = '.json';

    protected $configuration;

    public function __construct()
    {
        $this->load();
    }

    public function load()
    {
        $this->configuration = $this->loadMainConfiguration();
        $this->configuration['taxRates'] = $this->loadCountrySpecificConfiguration($this->configuration['default_country']);

        return $this->configuration;
    }

    public function loadMainConfiguration()
    {
        return Config::load(self::CONFIG_DIRECTORY . '/config' . self::CONFIG_FILE_TYPE, new Json())->all();
    }

    public function loadCountrySpecificConfiguration(string $countryCode)
    {
        return Config::load(self::COUNTRY_DIRECTORY . $countryCode . self::CONFIG_FILE_TYPE, new Json())->all();
    }

    public function shouldIncludeConfiguration()
    {
        return $this->configuration['include_configuration_in_the_response'];
    }

    public function shouldEnableFormatter($className)
    {
        $className = lcfirst($this->getClassName($className));

        return $this->configuration["include_{$className}_in_the_response"];
    }

    public function getTaxRates($className)
    {
        $className = lcfirst($this->getClassName($className));
        return $this->configuration['taxRates'][$className];
    }

    private function getClassName($className)
    {
        if ($pos = strrpos($className, '\\')) return substr($className, $pos + 1);

        return $pos;
    }

}