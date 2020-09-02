<?php


namespace VictorLava\SalaryCalculator\Helper;

use Noodlehaus\Config;
use Noodlehaus\Parser\Json;
use VictorLava\SalaryCalculator\Constant;
use VictorLava\SalaryCalculator\Helper\Path;

class File {

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
            $array[$i] = Path::removeFileExtension($fileName, $fileExtension);

            unset($array[$index]);
            $i++;
        }

        return $array;
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