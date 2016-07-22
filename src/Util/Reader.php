<?php

namespace RawPHP\CommunicationLogger\Util;

/**
 * Class Reader
 *
 * @package RawPHP\CommunicationLogger\Util
 */
class Reader implements IReader
{
    /**
     * Reads a directory and returns all of its file names.
     *
     * @param string $dir
     *
     * @return string[]
     */
    public function readDir(string $dir): array
    {
        return scandir($dir);
    }

    /**
     * Read a file.
     *
     * @param string $file
     *
     * @return string
     */
    public function read($file): string
    {
        $fp = fopen($file, 'r+');

        $contents = '';

        while ($part = fread($fp, 1024)) {
            $contents .= $part;
        }

        if (null !== $fp) {
            fclose($fp);
        }

        return $contents;
    }
}
