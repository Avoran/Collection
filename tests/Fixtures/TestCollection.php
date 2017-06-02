<?php

namespace Avoran\Collection\Fixtures;

use Avoran\Collection\Collection;

class TestCollection extends Collection
{
    public function onlyDeleted()
    {
        return $this->lazyFilter(function(TestClass $class) {
            return $class->isDeleted();
        });
    }
}
