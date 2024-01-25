<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Domain\Model\Traits;

use App\BookStore\Domain\Input\AuthorListInput;
use App\BookStore\Domain\Model\AuthorId;
use App\BookStore\Domain\Model\Traits\AuthorCollectionTrait;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use App\Tests\BookStore\Doubles\Domain\Model\AuthorDouble;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class AuthorCollectionTraitTest extends TestCase
{
    use BookStoreTrait;

    protected function setUp(): void
    {
        $this->authorId = new AuthorId();
        $sut = (new \ReflectionClass(AuthorCollectionExample::class))
            ->newInstanceWithoutConstructor()
        ;

        $initial = AuthorListInput::collect([
            $this->doubleAuthor(fn (AuthorDouble $double) => $double->withId($this->authorId)),
        ]);

        $sut->execute($initial);
        $this->sut = $sut;
    }

    public function test_it_create_an_collection_properly()
    {
        $this->assertCount(1, $this->sut->getAuthors());
        $this->assertSame($this->authorId, $this->sut->getAuthors()->get(0)->getId());
    }

    public function test_it_is_able_to_add_an_existing_element()
    {
        $input = AuthorListInput::collect([
            $this->doubleAuthor(fn (AuthorDouble $double) => $double->withId($this->authorId)),
            $this->doubleAuthor(),
            $this->doubleAuthor(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(3, $this->sut->getAuthors());
        $this->assertSame($this->authorId, $this->sut->getAuthors()->get(0)->getId());
    }

    public function test_it_is_able_to_create_a_new_element()
    {
        $input = AuthorListInput::collect([
            $this->doubleAuthor(fn (AuthorDouble $double) => $double->withId($this->authorId)),
            $this->doubleAuthorInput(),
            $this->doubleAuthorInput(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(3, $this->sut->getAuthors());
        $this->assertSame($this->authorId, $this->sut->getAuthors()->get(0)->getId());
    }

    public function test_it_is_able_to_remove_an_element()
    {
        $input = AuthorListInput::collect([
            $this->doubleAuthor(),
            $this->doubleAuthor(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(2, $this->sut->getAuthors());
        $this->assertNotSame($this->authorId, $this->sut->getAuthors()->get(0)->getId());
    }
}

class AuthorCollectionExample
{
    use AuthorCollectionTrait;

    public function execute(AuthorListInput $input)
    {
        $this->authorCollection($input);
    }
}
