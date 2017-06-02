<?php

namespace Avoran\Collection;

use Avoran\Collection\Fixtures\TestClass;
use Avoran\Collection\Fixtures\TestSoftDeletableCollection;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class SoftDeletableCollectionTest extends TestCase
{
    /** @test */
    public function soft_deletable_collections_should_be_countable()
    {
        $array = [
            new TestClass(true),
            new TestClass()
        ];

        $collection = new ArrayCollection($array);

        $this->assertCount(1, SoftDeletableCollection::fromArray($array));
        $this->assertCount(1, SoftDeletableCollection::fromCollection($collection));

        $this->assertCount(2, SoftDeletableCollection::fromArray($array)->includeSoftDeleted());
        $this->assertCount(2, SoftDeletableCollection::fromCollection($collection)->includeSoftDeleted());
    }

    /** @test */
    public function extended_collection_should_be_able_to_use_lazy_filter()
    {
        $array = [
            new TestClass(),
            new TestClass()
        ];

        $test = TestSoftDeletableCollection::fromArray($array)->onlyDeleted();

        $this->assertInstanceOf(TestSoftDeletableCollection::class, $test);
        $this->assertCount(0, $test);
    }
}
