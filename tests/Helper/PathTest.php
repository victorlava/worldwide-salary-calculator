<?php

namespace VictorLava\SalaryCalculator\Tests\Helper;

use PHPUnit\Framework\TestCase;
use VictorLava\SalaryCalculator\Helper\Path;

class PathTest extends TestCase
{
    /** @test */
    public function can_remove_file_extension_from_the_path()
    {
        $path = Path::removeFileExtension('config/config.json', 'json');
        $this->assertEquals('config/config', $path);
    }

    /** @test */
    public function can_convert_name_with_dashes_to_uppercase_first_without_spaces()
    {
        $name = Path::convertDashesToUppercaseFirst('include_default_response_somewhere');
        $this->assertEquals('includeDefaultResponseSomewhere', $name);
    }

    /** @test */
    public function can_add_default_country_code_to_the_end_of_path()
    {
        // TODO: refactore this
        $path = Path::addCountryCode('rates', 'config/rates');
        $this->assertEquals('config/rates/lt', $path);
    }

}