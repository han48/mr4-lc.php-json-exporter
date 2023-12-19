<?php

namespace Mr4Lc\JsonExporter;

use Mr4Lc\JsonExporter\Exception\FileOpenException;
use Mr4Lc\JsonExporter\Exception\FileWriteException;

class Writer
{

    /**
     * For testing only
     * Set $SAVE to true to save all written content in $written
     */
    public static bool $SAVE = false;
    public string $written = '';
    protected string $filename;

    /**
     * @var resource
     */
    private $handler;

    /**
     * @throws FileOpenException
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $handler = fopen($this->filename, 'w');

        if (!$handler) {
            throw new FileOpenException;
        }

        $this->handler = $handler;

    }

    /**
     * @throws FileWriteException
     */
    public function write(string $str) : void
    {
        $wrote = fwrite($this->handler, $str);

        if ($wrote === false) {
            throw new FileWriteException($this->filename, $str);
        }

        if (self::$SAVE) {
            $this->written .= $str;
        }
    }

}
