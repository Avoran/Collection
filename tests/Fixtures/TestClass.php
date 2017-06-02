<?php

namespace Avoran\Collection\Fixtures;

use Avoran\Collection\SoftDeletable;

class TestClass implements SoftDeletable
{
    private $deleted;

    public function __construct($deleted = false)
    {
        $this->deleted = $deleted;
    }

    public function isDeleted()
    {
        return $this->deleted;
    }
}
