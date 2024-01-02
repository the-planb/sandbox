<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Model;

use App\BookStore\Domain\Model\Tag;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class TagDouble extends Double
{
    public function reveal(): Tag
    {
        return $this->double->reveal();
    }

    public function withId(TagId $id): self
    {
        $this->double()
            ->getId()
            ->willReturn($id)
        ;

        return $this;
    }

    public function withName(TagName $name): self
    {
        $this->double()
            ->getName()
            ->willReturn($name)
        ;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return Tag::class;
    }

    protected function double(): ObjectProphecy|Tag
    {
        return $this->double;
    }
}
