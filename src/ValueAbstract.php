<?php

namespace Mr4Lc\JsonExporter;

abstract class ValueAbstract
{

    abstract public function end() : void;
    abstract public function endWithComma() : void;

}
