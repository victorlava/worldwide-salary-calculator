<?php


namespace VictorLava\SalaryCalculator\Helper;

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

    // TODO: solve this by getting the enable countryCode staticly
    public static function addCountryCodeToPath($directoryName, $pathName)
    {
        if(in_array($directoryName, Constant::DIRECTORIES_THAT_REQUIRE_COUNTRY_CODE))
        {
            // $pathName .= '/' . $this->countryCode;
        }

        return $pathName;
    }


}