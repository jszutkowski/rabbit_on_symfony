<?php
/**
 * Created by PhpStorm.
 * User: jszutkowski
 * Date: 06.03.18
 * Time: 20:39
 */

namespace App\Lib\File;


use App\Lib\Exception\InvalidPathException;

class FileListReader
{
    /**
     * @param string $path
     * @return string[]
     * @throws InvalidPathException
     */
    public function getFileList(string $path): array
    {
        $this->checkPath($path);

        $files = scandir($path);

        foreach ($files as $key => $file) {
            if ($file == '.' || $file == '..') {
                unset($files[$key]);
            }
        }

        return array_values($files);
    }

    /**
     * @param string $path
     * @throws InvalidPathException
     */
    private function checkPath(string $path): void
    {
        if (!file_exists($path) || !is_dir($path)) {
            throw new InvalidPathException('Path does not exist');
        }
    }

}