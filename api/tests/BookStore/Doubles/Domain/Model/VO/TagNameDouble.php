<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Model\VO;

use App\BookStore\Domain\Model\VO\TagName;
use PlanB\Framework\Testing\Double;
use PlanB\Framework\Testing\FakesTrait;
use Prophecy\Prophecy\ObjectProphecy;

final class TagNameDouble extends Double
{
    use FakesTrait;

    public function reveal(): TagName
    {
        return $this->double->reveal();
    }

    public function withName(string $name): self
    {
        $this->double()
            ->getName()
            ->willReturn($name)
        ;

        $this->double()
            ->__toString()
            ->willReturn($name)
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->withName($this->string());
    }

    protected function classNameOrInterface(): string
    {
        return TagName::class;
    }

    protected function double(): ObjectProphecy|TagName
    {
        return $this->double;
    }
}
