<?php

namespace VictorLava\SalaryCalculator\Tests\Helper;

use PHPUnit\Framework\TestCase;
use VictorLava\SalaryCalculator\Helper\App;

class AppTest extends TestCase
{
    /** @test */
    public function can_get_one_of_the_configuration_properties()
    {
        $this->assertEquals('lt', App::get()->default_country);
    }

    /** @test */
    public function can_get_one_of_the_configuration_properties_statically()
    {
        $this->assertEquals('lt', App::defaultCountry());
    }

}