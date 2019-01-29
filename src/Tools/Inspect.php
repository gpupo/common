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

class Inspect
{
    /**
     * get the full name (name \ namespace) of a class from its file path
     * result example: (string) "I\Am\The\Namespace\Of\This\Class".
     */
    public function getClassFullNameFromFile(string $filePathName): string
    {
        return $this->getClassNamespaceFromFile($filePathName).'\\'.$this->getClassNameFromFile($filePathName);
    }

    /**
     * get the class namespace form file path using token.
     */
    protected function getClassNamespaceFromFile(string $filePathName): ?string
    {
        $src = file_get_contents($filePathName);

        $tokens = token_get_all($src);
        $count = \count($tokens);
        $i = 0;
        $namespace = '';
        $namespace_ok = false;
        while ($i < $count) {
            $token = $tokens[$i];
            if (\is_array($token) && T_NAMESPACE === $token[0]) {
                // Found namespace declaration
                while (++$i < $count) {
                    if (';' === $tokens[$i]) {
                        $namespace_ok = true;
                        $namespace = trim($namespace);

                        break;
                    }
                    $namespace .= \is_array($tokens[$i]) ? $tokens[$i][1] : $tokens[$i];
                }

                break;
            }
            ++$i;
        }
        if (!$namespace_ok) {
            return null;
        }

        return $namespace;
    }

    /**
     * get the class name form file path using token.
     *
     * @return mixed
     */
    protected function getClassNameFromFile(string $filePathName)
    {
        $php_code = file_get_contents($filePathName);

        $classes = [];
        $tokens = token_get_all($php_code);
        $count = \count($tokens);
        for ($i = 2; $i < $count; ++$i) {
            if (T_CLASS === $tokens[$i - 2][0]
                    && T_WHITESPACE === $tokens[$i - 1][0]
                    && T_STRING === $tokens[$i][0]
                ) {
                $class_name = $tokens[$i][1];
                $classes[] = $class_name;
            }
        }

        return $classes[0];
    }
}
