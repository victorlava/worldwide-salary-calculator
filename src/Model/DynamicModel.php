<?php

namespace VictorLava\SalaryCalculator\Model;

use VictorLava\SalaryCalculator\Configuration;
use VictorLava\SalaryCalculator\Constant;

class DynamicModel extends AbstractModel {

    protected $countryCode;

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

    public function addCountryCodeIfDirectoryRequiresIt($directoryName, $pathName)
    {
        if(in_array($directoryName, Constant::DIRECTORIES_THAT_REQUIRE_COUNTRY_CODE))
        {
            $pathName .= '/' . $this->countryCode;
        }

        return $pathName;
    }

    public function define()
    {
        $fullDirectoryPath = $this->addCountryCodeIfDirectoryRequiresIt($this->directoryName, 'config/'. $this->directoryName);

        $fileNames = $this->listFiles($fullDirectoryPath);
        $properties = [];

        foreach($fileNames as $fileName)
        {
            $properties = $this->configurationServiceProvider->loadFromCustomFile($fullDirectoryPath . '/' . $fileName . '.' . Constant::CONFIG_FILE_EXTENSION);
            $this->defineProperties($properties, $fileName);

        }

        return $properties;
    }

    public function listFiles($directory) {
        $fileList = scandir($directory);

        // Unset ., ..
        unset($fileList[0]);
        unset($fileList[1]);

        $fileList = $this->reIndexArrayAndDropFileExtension($fileList, Constant::CONFIG_FILE_EXTENSION);

        return $fileList;
    }

    public function reIndexArrayAndDropFileExtension($array, $fileExtension)
    {
        $i = 0;

        foreach ($array as $index => $fileName) {
            $array[$i] = $this->dropFileExtensionFromFileName($fileName, $fileExtension);

            unset($array[$index]);
            $i++;
        }

        return $array;
    }

    public function dropFileExtensionFromFileName($fileName, $fileExtension)
    {
        return str_replace(".$fileExtension", '', $fileName);
    }


}