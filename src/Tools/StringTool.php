<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://opensource.gpupo.com/>.
 *
 */

namespace Gpupo\Common\Tools;

class StringTool
{
    /**
     * Convert CamelCase to snake_case.
     *
     * @param string $input MyString
     *
     * @return string my_string
     */
    public static function camelCaseToSnakeCase($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match === strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }

    /**
     * Convert snake_case to CamelCase.
     *
     * @param string $input                    MyString
     * @param bool   $capitalizeFirstCharacter
     *
     * @return string my_string
     */
    public static function snakeCaseToCamelCase($input, $capitalizeFirstCharacter = false)
    {
        $str = str_replace('_', '', ucwords($input, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    public static function normalizeToSingular($string)
    {
        return rtrim($string, 's');
    }

    public static function normalizeToPlural($string)
    {
        return sprintf('%ss', self::normalizeToSingular($string));
    }

    public static function normalizeToSlug($string)
    {
        return str_replace('\\', '_', $string);
    }
}
