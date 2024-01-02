<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Model;

use App\BookStore\Domain\Model\Author;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class AuthorDouble extends Double
{
    public function reveal(): Author
    {
        return $this->double->reveal();
    }

    public function withId(AuthorId $id): self
    {
        $this->double()
            ->getId()
            ->willReturn($id)
        ;

        return $this;
    }

    public function withName(FullName $name): self
    {
        $this->double()
            ->getName()
            ->willReturn($name)
        ;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return Author::class;
    }

    protected function double(): ObjectProphecy|Author
    {
        return $this->double;
    }
}
