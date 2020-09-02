<?php

namespace VictorLava\SalaryCalculator\Model;

use VictorLava\SalaryCalculator\Helper;
use VictorLava\SalaryCalculator\Configuration;
use VictorLava\SalaryCalculator\Constant;

class DynamicModel extends AbstractModel {

    protected $countryCode;

    protected $fileName;

    protected $directoryName;

    public function __construct()
    {
        $this->configurationServiceProvider = new Configuration();
        $this->configuration = $this->configurationServiceProvider->load();
        $this->countryCode = $this->configuration['default_country'];

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
        $configuration = $this->configurationServiceProvider;

        if($this->fileName !== null) {
            $this->defineFromFileName($configuration);
        } else {
            $this->defineFromFileDirectory($configuration);
        }
    }

    public function defineFromFileName(Configuration $configuration)
    {
        $properties = $configuration->loadFromCustomFile("config/{$this->fileName}." . Constant::CONFIG_FILE_EXTENSION);
        $this->defineProperties($properties);
    }

    public function defineFromFileDirectory(Configuration $configuration)
    {
        $fullDirectoryPath = File::addCountryCodeToPath($this->directoryName, "config/$this->directoryName");

        $fileNames = File::getList($fullDirectoryPath);

        foreach ($fileNames as $fileName) {
            $properties = $configuration->loadFromCustomFile("$fullDirectoryPath/$fileName." . Constant::CONFIG_FILE_EXTENSION);
            $this->defineProperties($properties, $fileName);
        }
    }

}