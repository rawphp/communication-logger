<?php

namespace RawPHP\CommunicationLogger\Util;

/**
 * Class Writer
 *
 * @package RawPHP\CommunicationLogger\Util
 */
class Writer implements IWriter
{
    /** @var  mixed */
    protected $fileDescriptor;

    /**
     * Open file.
     *
     * @param string $file
     * @param string $mode
     *
     * @return IWriter
     */
    public function open($file, $mode): IWriter
    {
        $this->fileDescriptor = fopen($file, $mode);

        return $this;

    }

    /**
     * Checks whether a file has been opened.
     *
     * @return bool
     */
    public function isOpen(): bool
    {
        return (null !== $this->fileDescriptor && is_resource($this->fileDescriptor));
    }

    /**
     * Write to the file.
     *
     * @param string $text
     *
     * @return IWriter
     */
    public function write($text): IWriter
    {
        fwrite($this->fileDescriptor, $text);

        return $this;
    }

    /**
     * Close the file.
     */
    public function close()
    {
        fclose($this->fileDescriptor);
    }
}
