<?php

namespace VictorLava\SalaryCalculator\Tests;

use Noodlehaus\Config;
use Noodlehaus\Parser\Json;
use PHPUnit\Framework\TestCase;
use VictorLava\SalaryCalculator\Configuration;

class ConfigurationTest extends TestCase
{
    private $configurationServiceProvider;

    private $configuration;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        $this->configurationServiceProvider = new Configuration();
        $this->configuration = $this->configurationServiceProvider->loadMainConfiguration();

        parent::__construct($name, $data, $dataName);
    }

    /** @test */
    public function load_main_configuration()
    {
        $this->assertEquals([
            'use_external_api' => false,
            'default_country' => 'lt'
        ], $this->configuration);
    }

    /** @test */
    public function load_country_specific_configurations()
    {
        $configurations = $this->configurationServiceProvider->loadCountrySpecificConfiguration($this->configuration['default_country']);

        $this->assertEquals(["employee" => [
            "social_security_tax" => 6.98,
            "pension_insurance" => 8.72,
            "sickness_social_security" => 2.09,
            "maternity_social_security" => 1.71,
            "health_insurance" => 0,
            "working_level" => 100,
            "income_tax" => 20
        ]], $configurations);
    }

}