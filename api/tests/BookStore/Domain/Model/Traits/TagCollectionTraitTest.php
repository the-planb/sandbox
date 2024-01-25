<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Domain\Model\Traits;

use App\BookStore\Domain\Input\TagListInput;
use App\BookStore\Domain\Model\TagId;
use App\BookStore\Domain\Model\Traits\TagCollectionTrait;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use App\Tests\BookStore\Doubles\Domain\Model\TagDouble;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class TagCollectionTraitTest extends TestCase
{
    use BookStoreTrait;

    protected function setUp(): void
    {
        $this->tagId = new TagId();
        $sut = (new \ReflectionClass(TagCollectionExample::class))
            ->newInstanceWithoutConstructor()
        ;

        $initial = TagListInput::collect([
            $this->doubleTag(fn (TagDouble $double) => $double->withId($this->tagId)),
        ]);

        $sut->execute($initial);
        $this->sut = $sut;
    }

    public function test_it_create_an_collection_properly()
    {
        $this->assertCount(1, $this->sut->getTags());
        $this->assertSame($this->tagId, $this->sut->getTags()->get(0)->getId());
    }

    public function test_it_is_able_to_add_an_existing_element()
    {
        $input = TagListInput::collect([
            $this->doubleTag(fn (TagDouble $double) => $double->withId($this->tagId)),
            $this->doubleTag(),
            $this->doubleTag(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(3, $this->sut->getTags());
        $this->assertSame($this->tagId, $this->sut->getTags()->get(0)->getId());
    }

    public function test_it_is_able_to_create_a_new_element()
    {
        $input = TagListInput::collect([
            $this->doubleTag(fn (TagDouble $double) => $double->withId($this->tagId)),
            $this->doubleTagInput(),
            $this->doubleTagInput(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(3, $this->sut->getTags());
        $this->assertSame($this->tagId, $this->sut->getTags()->get(0)->getId());
    }

    public function test_it_is_able_to_remove_an_element()
    {
        $input = TagListInput::collect([
            $this->doubleTag(),
            $this->doubleTag(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(2, $this->sut->getTags());
        $this->assertNotSame($this->tagId, $this->sut->getTags()->get(0)->getId());
    }
}

class TagCollectionExample
{
    use TagCollectionTrait;

    public function execute(TagListInput $input)
    {
        $this->tagCollection($input);
    }
}
