<?php

namespace Avoran\Collection;

use Avoran\Collection\Fixtures\TestClass;
use Avoran\Collection\Fixtures\TestCollection;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    /** @test */
    public function collections_should_be_countable()
    {
        $array = [
            new TestClass(),
            new TestClass()
        ];

        $collection = new ArrayCollection($array);

        $this->assertCount(2, Collection::fromArray($array));
        $this->assertCount(2, Collection::fromCollection($collection));
    }

    /** @test */
    public function extended_collection_should_be_able_to_use_lazy_filter()
    {
        $array = [
            new TestClass(),
            new TestClass()
        ];

        $test = TestCollection::fromArray($array)->onlyDeleted();

        $this->assertInstanceOf(TestCollection::class, $test);
        $this->assertCount(0, $test);
    }
}
