<?php
/**
 * Created by PhpStorm.
 * User: jszutkowski
 * Date: 07.03.18
 * Time: 18:38
 */

namespace App\Lib\File;


use App\Lib\Exception\FileNotFoundException;

interface FileHandlerInterface
{
    /**
     * @param string $filePath
     * @param $content
     * @throws FileNotFoundException
     */
    function putContent(string $filePath, $content): void;
}