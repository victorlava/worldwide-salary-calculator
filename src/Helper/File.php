<?php

namespace VictorLava\SalaryCalculator\Helper;


use VictorLava\SalaryCalculator\Constant;

class File {

   public static function addCountryCodeToPath($directoryName, $pathName)
   {
       // TODO: solve this by getting the enable countryCode staticly
       if(in_array($directoryName, Constant::DIRECTORIES_THAT_REQUIRE_COUNTRY_CODE))
       {
           // $pathName .= '/' . $this->countryCode;
       }

       return $pathName;
   }

   public static function removeExtensionFromTheName($fileName, $fileExtension)
   {
       return str_replace(".$fileExtension", '', $fileName);
   }

   public static function getList($directory) {
        $fileList = scandir($directory);

        // Unset ., ..
        unset($fileList[0]);
        unset($fileList[1]);

        $fileList = self::reIndexArrayAndRemoveExtensionName($fileList, Constant::CONFIG_FILE_EXTENSION);

        return $fileList;
    }

    public static function reIndexArrayAndRemoveExtensionName($array, $fileExtension)
    {
        $i = 0;

        foreach ($array as $index => $fileName) {
            $array[$i] = self::removeExtensionFromTheName($fileName, $fileExtension);

            unset($array[$index]);
            $i++;
        }

        return $array;
    }


}