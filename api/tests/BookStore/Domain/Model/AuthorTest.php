<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Domain\Model;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\AuthorId;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class AuthorTest extends TestCase
{
    use BookStoreTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $name = $this->doubleFullName();

        $author = new Author(...[
            'name' => $name,
        ]);

        $this->assertInstanceOf(AuthorId::class, $author->getId());
        $this->assertSame($author->getName(), $name);
    }

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_updated_properly()
    {
        $author = (new \ReflectionClass(Author::class))
            ->newInstanceWithoutConstructor()
        ;

        $name = $this->doubleFullName();

        $author->update(...[
            'name' => $name,
        ]);

        $this->assertSame($author->getName(), $name);
    }
}
