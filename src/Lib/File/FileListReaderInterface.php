<?php
/**
 * Created by PhpStorm.
 * User: jszutkowski
 * Date: 07.03.18
 * Time: 18:37
 */

namespace App\Lib\File;


use App\Lib\Exception\InvalidPathException;

interface FileListReaderInterface
{
    /**
     * @param string $path
     * @return string[]
     * @throws InvalidPathException
     */
    function getFileList(string $path): array;
}