<?php
/**
 * Created by PhpStorm.
 * User: jszutkowski
 * Date: 06.03.18
 * Time: 20:39
 */

namespace App\Lib\File;


use App\Lib\Exception\InvalidPathException;

class FileListReader implements FileListReaderInterface
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
            } else {
                $files[$key] = $this->getFullPath($path, $file);
            }
        }

        return array_values($files);
    }

    private function getFullPath(string $path, string $filename): string
    {
        return $path . (substr($path, -1) == '/' ? '' : '/') . $filename;
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