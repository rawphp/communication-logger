<?php

namespace RawPHP\CommunicationLogger\Util;

/**
 * Class Reader
 *
 * @package RawPHP\CommunicationLogger\Util
 */
interface IReader
{
    /**
     * Reads a directory and returns all of its file names.
     *
     * @param string $dir
     *
     * @return string[]
     */
    public function readDir(string $dir): array;

    /**
     * Read a file.
     *
     * @param string $file
     *
     * @return string
     */
    public function read($file): string;
}
