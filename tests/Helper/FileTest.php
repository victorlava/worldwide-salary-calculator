<?php

namespace VictorLava\SalaryCalculator\Tests\Helper;

use PHPUnit\Framework\TestCase;
use VictorLava\SalaryCalculator\Helper\File;

class FileTest extends TestCase
{
    /** @test */
    public function can_return_list_of_files_in_a_directory()
    {
        $fileList = File::getList('config/rates/lt');
        $this->assertEquals([
            'contractor',
            'employee',
            'lt'
        ], $fileList);
    }

    /** @test */
    public function can_load_a_configuration_file_from_the_custom_path()
    {
        $fileList = File::loadFromCustomPath('config/config.json');
        $this->assertEquals([
            "include_configuration_in_the_response" => false,
            "include_tax_in_the_response" => true,
            "include_salary_in_the_response" => true,
            "default_country" => "lt"
        ], $fileList);
    }


}