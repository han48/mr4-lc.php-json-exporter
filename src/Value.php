<?php

namespace Mr4Lc\JsonExporter;

use Mr4Lc\JsonExporter\Exception\JsonEncodingException;

class Value extends ValueAbstract
{
    protected string $key;
    protected $value;
    protected Writer $writer;
    protected bool $encode;

    public function __construct(
        string $key,
        $value,
        Writer $writer,
        bool $encode = true
    ) {
        $this->key = $key;
        $this->value = $value;
        $this->writer = $writer;
        $this->encode = $encode;

        $this->writer->write("\"$this->key\":");

        $json = $this->encode ? json_encode($this->value) : strval($this->value);

        if ($json === false)
            throw new JsonEncodingException;

        $this->writer->write($json);
    }

    public function end(): void
    {}

    public function endWithComma(): void
    {
        $this->writer->write(',');
    }
}
