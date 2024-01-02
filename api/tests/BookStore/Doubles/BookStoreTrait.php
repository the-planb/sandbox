<?php

namespace App\Tests\BookStore\Doubles;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\AuthorList;
use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Model\BookList;
use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Model\TagList;
use App\BookStore\Domain\Model\VO\FullName;
use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\TagName;
use App\BookStore\Domain\Model\VO\Title;
use App\Tests\BookStore\Doubles\Domain\Model\AuthorDouble;
use App\Tests\BookStore\Doubles\Domain\Model\AuthorListDouble;
use App\Tests\BookStore\Doubles\Domain\Model\BookDouble;
use App\Tests\BookStore\Doubles\Domain\Model\BookListDouble;
use App\Tests\BookStore\Doubles\Domain\Model\TagDouble;
use App\Tests\BookStore\Doubles\Domain\Model\TagListDouble;
use App\Tests\BookStore\Doubles\Domain\Model\VO\FullNameDouble;
use App\Tests\BookStore\Doubles\Domain\Model\VO\PriceDouble;
use App\Tests\BookStore\Doubles\Domain\Model\VO\TagNameDouble;
use App\Tests\BookStore\Doubles\Domain\Model\VO\TitleDouble;
use Prophecy\PhpUnit\ProphecyTrait;

trait BookStoreTrait
{
    use ProphecyTrait;

    /**
     * @throws \ReflectionException
     */
    private function doubleFullName(callable $configure = null): FullName
    {
        $builder = new FullNameDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleTagName(callable $configure = null): TagName
    {
        $builder = new TagNameDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleBook(callable $configure = null): Book
    {
        $builder = new BookDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleBookList(callable $configure = null): BookList
    {
        $builder = new BookListDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleAuthor(callable $configure = null): Author
    {
        $builder = new AuthorDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleAuthorList(callable $configure = null): AuthorList
    {
        $builder = new AuthorListDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleTag(callable $configure = null): Tag
    {
        $builder = new TagDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleTagList(callable $configure = null): TagList
    {
        $builder = new TagListDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doublePrice(callable $configure = null): Price
    {
        $builder = new PriceDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleTitle(callable $configure = null): Title
    {
        $builder = new TitleDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }
}
