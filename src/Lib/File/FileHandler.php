<?php
/**
 * Created by PhpStorm.
 * User: jszutkowski
 * Date: 06.03.18
 * Time: 20:50
 */

namespace App\Lib\File;


use App\Lib\Exception\FileNotFoundException;

class FileHandler implements FileHandlerInterface
{

    /**
     * @param string $filePath
     * @param $content
     * @throws FileNotFoundException
     */
    public function putContent(string $filePath, $content): void
    {
        $this->checkFile($filePath);
        file_put_contents($filePath, $content);
    }

    /**
     * @param string $filePath
     * @throws FileNotFoundException
     */
    private function checkFile(string $filePath): void
    {
        if (!file_exists($filePath) || !is_file($filePath) || !is_writable($filePath)) {
            throw new FileNotFoundException('File does not exist');
        }
    }
}