<?php

namespace Avoran\Collection;

use Doctrine\Common\Collections\AbstractLazyCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as DoctrineCollection;

class Collection extends AbstractLazyCollection
{
    private $completeCollection;

    private function __construct(DoctrineCollection $collection)
    {
        $this->completeCollection = $collection;
    }

    public static function fromArray(array $array) { return new static(new ArrayCollection($array)); }
    public static function fromCollection(DoctrineCollection $collection) { return new static($collection); }

    protected function lazyFilter(callable $function)
    {
        return new static($this->completeCollection->filter($function));
    }

    protected function doInitialize()
    {
        $this->collection = $this->completeCollection;
    }
}
