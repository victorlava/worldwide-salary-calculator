<?php


namespace VictorLava\SalaryCalculator\Helper;

use Noodlehaus\Config;
use Noodlehaus\Parser\Json;
use VictorLava\SalaryCalculator\Constant;

class File {

    /**
     * Remove's the requested file extension type from the supplied file name.
     *
     * @param  string  $fileName
     * @param  string  $fileExtension
     *
     * @return string
     */
   public static function removeExtensionFromTheName(string $fileName, string $fileExtension): string
   {
       return str_replace(".$fileExtension", '', $fileName);
   }

    /**
     * Converts name with dashes to name without dashes/spaces and with first letter uppercased. For ex. default_country => defaultCountry
     *
     * @param  string  $name
     *
     * @return string
     */
    public static function convertNameWithDashesToUppercaseFirst(string $name)
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
     * Return's a clean list of file names (without file extension types) in the requested directory.
     *
     * @param  string  $directory
     *
     * @return array
     */
   public static function getList(string $directory): array
   {
        $fileList = scandir($directory);

        // Unset ., ..
        unset($fileList[0]);
        unset($fileList[1]);

        $fileList = self::reIndexArrayAndRemoveExtensionName($fileList, Constant::CONFIG_FILE_EXTENSION);

        return $fileList;
    }

     /**
      * Re-index'es an array and removes file type extensions, for ex. ".json"
      *
      * @param  array  $array
      * @param  string  $fileExtension
      *
      * @return array
      */
    public static function reIndexArrayAndRemoveExtensionName(array $array, string $fileExtension): array
    {
        $i = 0;

        foreach ($array as $index => $fileName) {
            $array[$i] = self::removeExtensionFromTheName($fileName, $fileExtension);

            unset($array[$index]);
            $i++;
        }

        return $array;
    }

    /**
     * Re-index'es an array and removes file type extensions, for ex. ".json"
     *
     * @param  string  $directoryName
     * @param  string  $pathName
     *
     * @return string
     */
    public static function addCountryCodeToPath(string $directoryName, string $pathName)
    {
        if(in_array($directoryName, Constant::DIRECTORIES_THAT_REQUIRE_COUNTRY_CODE))
        {
             $pathName .= '/' . App::defaultCountry();
        }

        return $pathName;
    }

    /**
     * Load's the config file from custom path and returns an array.
     *
     * @param  string  $pathToFile

     * @return array
     */
    public static function loadFromCustomPath($pathToFile)
    {
        return Config::load($pathToFile, new Json())->all();
    }

}