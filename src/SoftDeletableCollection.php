<?php

namespace Avoran\Collection;

use Doctrine\Common\Collections\AbstractLazyCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as DoctrineCollection;

class SoftDeletableCollection extends AbstractLazyCollection
{
    private $includeSoftDeleted;
    private $completeCollection;

    private function __construct(DoctrineCollection $collection, $includeSoftDeleted)
    {
        $this->includeSoftDeleted = $includeSoftDeleted;
        $this->completeCollection = $collection;
    }

    public static function fromArray(array $array) { return new static(new ArrayCollection($array), false); }
    public static function fromCollection(DoctrineCollection $collection) { return new static($collection, false); }

    public function includeSoftDeleted() { return new static($this->completeCollection, true); }

    protected function lazyFilter(callable $function)
    {
        return new static($this->completeCollection->filter($function), $this->includeSoftDeleted);
    }

    protected function doInitialize()
    {
        if ($this->includeSoftDeleted) $this->collection = $this->completeCollection;
        else $this->collection = $this->completeCollection->filter(function(SoftDeletable $c) {
            return !$c->isDeleted();
        });
    }
}
