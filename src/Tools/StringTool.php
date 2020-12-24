<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
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
            $match = $match === mb_strtoupper($match) ? mb_strtolower($match) : lcfirst($match);
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

    public static function slugify(string $source): string
    {
        $slug = \transliterator_transliterate('Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();', $source);

        if (false === $slug) {
            throw new \InvalidArgumentException(sprintf('Incorrect source string "%s".', $source));
        }

        $slug = \strtr($slug, [' ' => '-', '_' => '-']);
        $slug = \preg_replace('#^\-|[^a-z0-9\-]|\-$#', '', $slug);

        if (false === \is_string($slug)) {
            throw new \RuntimeException(sprintf('Can not remove special chars from "%s".', $source));
        }

        $slug = \preg_replace('#(\-+)#', '-', $slug);

        if (false === \is_string($slug)) {
            throw new \RuntimeException(sprintf('Can not remove "-" duplicates "%s".', $source));
        }

        return $slug;
    }
}
