<?php

namespace VictorLava\SalaryCalculator\Model;

use VictorLava\SalaryCalculator\Constant;
use VictorLava\SalaryCalculator\Helper\File;

class DynamicModel extends AbstractModel {

    protected $fileName;

    protected $directoryName;

    public function __construct()
    {
        $this->define();
    }

    public function defineProperties($properties, $parentProperty = null)
    {
        if($parentProperty === null)
        {
            foreach($properties as $key => $value)
            {
               $this->{$key} = $value;
            }

            return;
        }

        foreach($properties as $key => $value)
        {
            $this->{$parentProperty} = new \stdClass();
            $this->{$parentProperty}->{$key} = $value;
        }
    }

    public function define()
    {
        if($this->fileName !== null) {
            $this->defineFromFileName();
        } else {
            $this->defineFromFileDirectory();
        }
    }

    public function defineFromFileName()
    {
        $properties = File::loadFromCustomPath("config/{$this->fileName}." . Constant::CONFIG_FILE_EXTENSION);
        $this->defineProperties($properties);
    }

    public function defineFromFileDirectory()
    {
        $fullDirectoryPath = File::addCountryCodeToPath($this->directoryName, "config/$this->directoryName");

        $fileNames = File::getList($fullDirectoryPath);

        foreach ($fileNames as $fileName) {
            $properties = File::loadFromCustomPath("$fullDirectoryPath/$fileName." . Constant::CONFIG_FILE_EXTENSION);
            $this->defineProperties($properties, $fileName);
        }
    }

}