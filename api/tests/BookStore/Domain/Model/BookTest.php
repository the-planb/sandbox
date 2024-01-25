<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Domain\Model;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Model\BookId;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class BookTest extends TestCase
{
    use BookStoreTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $title = $this->doubleTitle();
        $price = $this->doublePrice();
        $author = $this->doubleAuthor();
        $tags = $this->doubleTagListInput();

        $book = new Book(...[
            'title' => $title,
            'price' => $price,
            'author' => $author,
            'tags' => $tags,
        ]);

        $this->assertInstanceOf(BookId::class, $book->getId());
        $this->assertSame($book->getTitle(), $title);
        $this->assertSame($book->getPrice(), $price);
        $this->assertSame($book->getAuthor(), $author);
        $this->assertSame($book->getTags()->toArray(), $tags->toArray());
    }

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_updated_properly()
    {
        $book = (new \ReflectionClass(Book::class))
            ->newInstanceWithoutConstructor()
        ;

        $title = $this->doubleTitle();
        $price = $this->doublePrice();
        $author = $this->doubleAuthor();
        $tags = $this->doubleTagListInput();
        $book->update(...[
            'title' => $title,
            'price' => $price,
            'author' => $author,
            'tags' => $tags,
        ]);

        $this->assertSame($book->getTitle(), $title);
        $this->assertSame($book->getPrice(), $price);
        $this->assertSame($book->getAuthor(), $author);
        $this->assertSame($book->getTags()->toArray(), $tags->toArray());
    }
}
