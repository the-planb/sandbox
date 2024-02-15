<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Model\VO;

use App\BookStore\Domain\Model\VO\Title;
use PlanB\Framework\Testing\Double;
use PlanB\Framework\Testing\FakesTrait;
use Prophecy\Prophecy\ObjectProphecy;

final class TitleDouble extends Double
{
    use FakesTrait;

    public function reveal(): Title
    {
        return $this->double->reveal();
    }

    public function withTitle(string $title): self
    {
        $this->double()
            ->getTitle()
            ->willReturn($title)
        ;

        $this->double()
            ->__toString()
            ->willReturn($title)
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->withTitle($this->string());
    }

    protected function classNameOrInterface(): string
    {
        return Title::class;
    }

    protected function double(): ObjectProphecy|Title
    {
        return $this->double;
    }
}
