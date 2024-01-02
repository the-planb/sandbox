<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Domain\Model;

use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Model\TagId;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class TagTest extends TestCase
{
    use BookStoreTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $name = $this->doubleTagName();

        $tag = new Tag(...[
            'name' => $name,
        ]);

        $this->assertInstanceOf(TagId::class, $tag->getId());
        $this->assertSame($tag->getName(), $name);
    }

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_updated_properly()
    {
        $tag = (new \ReflectionClass(Tag::class))
            ->newInstanceWithoutConstructor()
        ;

        $name = $this->doubleTagName();
        $tag->update(...[
            'name' => $name,
        ]);

        $this->assertSame($tag->getName(), $name);
    }
}
