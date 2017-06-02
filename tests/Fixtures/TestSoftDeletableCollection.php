<?php

namespace Avoran\Collection\Fixtures;

use Avoran\Collection\SoftDeletableCollection;

class TestSoftDeletableCollection extends SoftDeletableCollection
{
    public function onlyDeleted()
    {
        return $this->lazyFilter(function(TestClass $class) {
            return $class->isDeleted();
        });
    }
}
