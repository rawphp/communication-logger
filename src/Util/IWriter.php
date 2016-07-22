<?php

namespace RawPHP\CommunicationLogger\Util;

/**
 * Class Writer
 *
 * @package RawPHP\CommunicationLogger\Util
 */
interface IWriter
{
    /**
     * Open file.
     *
     * @param string $file
     * @param string $mode
     *
     * @return IWriter
     */
    public function open($file, $mode): IWriter;

    /**
     * Checks whether a file has been opened.
     *
     * @return bool
     */
    public function isOpen(): bool;

    /**
     * Write to the file.
     *
     * @param string $text
     *
     * @return IWriter
     */
    public function write($text): IWriter;

    /**
     * Close the file.
     */
    public function close();
}
