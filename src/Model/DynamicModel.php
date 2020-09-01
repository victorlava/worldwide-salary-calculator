<?php

namespace VictorLava\SalaryCalculator\Model;

use VictorLava\SalaryCalculator\Configuration;

class DynamicModel extends AbstractModel {

    protected $fileExtension = "json";

    protected $countryCode;

    public function __construct()
    {
        $this->configurationServiceProvider = new Configuration();
        $this->configuration = $this->configurationServiceProvider->load();

        $this->countryCode = $this->configuration['default_country'];
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

    public function load()
    {
        $fullDirectory = 'config/'. $this->directory . '/' . $this->countryCode;

        $fileNames = $this->listFiles($fullDirectory);
        $properties = [];

        foreach($fileNames as $fileName)
        {
            $properties = $this->configurationServiceProvider->loadFromCustomFile($fullDirectory . '/' . $fileName . '.' . $this->fileExtension);
            $this->defineProperties($properties, $fileName);

        }

        return $properties;
    }

    public function listFiles($directory) {
        $fileList = scandir($directory);

        // Unset ., ..
        unset($fileList[0]);
        unset($fileList[1]);

        $fileList = $this->reIndexArrayAndDropFileExtension($fileList, $this->fileExtension);

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