<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Domain\Model\Traits;

use App\BookStore\Domain\Input\BookListInput;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Model\Traits\BookCollectionTrait;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use App\Tests\BookStore\Doubles\Domain\Model\BookDouble;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class BookCollectionTraitTest extends TestCase
{
    use BookStoreTrait;

    protected function setUp(): void
    {
        $this->bookId = new BookId();
        $sut = (new \ReflectionClass(BookCollectionExample::class))
            ->newInstanceWithoutConstructor()
        ;

        $initial = BookListInput::collect([
            $this->doubleBook(fn (BookDouble $double) => $double->withId($this->bookId)),
        ]);

        $sut->execute($initial);
        $this->sut = $sut;
    }

    public function test_it_create_an_collection_properly()
    {
        $this->assertCount(1, $this->sut->getBooks());
        $this->assertSame($this->bookId, $this->sut->getBooks()->get(0)->getId());
    }

    public function test_it_is_able_to_add_an_existing_element()
    {
        $input = BookListInput::collect([
            $this->doubleBook(fn (BookDouble $double) => $double->withId($this->bookId)),
            $this->doubleBook(),
            $this->doubleBook(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(3, $this->sut->getBooks());
        $this->assertSame($this->bookId, $this->sut->getBooks()->get(0)->getId());
    }

    public function test_it_is_able_to_create_a_new_element()
    {
        $input = BookListInput::collect([
            $this->doubleBook(fn (BookDouble $double) => $double->withId($this->bookId)),
            $this->doubleBookInput(),
            $this->doubleBookInput(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(3, $this->sut->getBooks());
        $this->assertSame($this->bookId, $this->sut->getBooks()->get(0)->getId());
    }

    public function test_it_is_able_to_remove_an_element()
    {
        $input = BookListInput::collect([
            $this->doubleBook(),
            $this->doubleBook(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(2, $this->sut->getBooks());
        $this->assertNotSame($this->bookId, $this->sut->getBooks()->get(0)->getId());
    }
}

class BookCollectionExample
{
    use BookCollectionTrait;

    public function execute(BookListInput $input)
    {
        $this->bookCollection($input);
    }
}
