<?php


namespace VictorLava\SalaryCalculator\Helper;

use Noodlehaus\Config;
use Noodlehaus\Parser\Json;
use VictorLava\SalaryCalculator\Constant;

class Path {

    /**
     * Remove's the requested file extension type from the supplied file name.
     *
     * @param  string  $fileName
     * @param  string  $fileExtension
     *
     * @return string
     */
    public static function removeFileExtension(string $fileName, string $fileExtension): string
    {
        return str_replace(".$fileExtension", '', $fileName);
    }

    /**
     * Converts name with dashes to name without dashes/spaces and with first letter upper cased. For ex. default_country => defaultCountry
     *
     * @param  string  $name
     *
     * @return string
     */
    public static function convertDashesToUppercaseFirst(string $name)
    {
        $explodedString = explode('_', $name);
        $finalString = '';

        for($i = 0; $i < count($explodedString); $i++)
        {
            if($i === 0) {
                $finalString .= $explodedString[$i];
                continue;
            }

            $explodedString[$i] = ucfirst($explodedString[$i]);
            $finalString .= $explodedString[$i];

        }

        return $finalString;
    }

    /**
     * Re-index'es an array and removes file type extensions, for ex. ".json"
     *
     * @param  string  $directoryName
     * @param  string  $pathName
     *
     * @return string
     */
    public static function addCountryCode(string $directoryName, string $pathName)
    {
        if(in_array($directoryName, Constant::DIRECTORIES_THAT_REQUIRE_COUNTRY_CODE))
        {
            $pathName .= '/' . App::defaultCountry();
        }

        return $pathName;
    }

}