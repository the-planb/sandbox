<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Model\VO;

use App\BookStore\Domain\Model\VO\Price;
use PlanB\Framework\Testing\Double;
use PlanB\Framework\Testing\FakesTrait;
use Prophecy\Prophecy\ObjectProphecy;

final class PriceDouble extends Double
{
    use FakesTrait;

    public function reveal(): Price
    {
        return $this->double->reveal();
    }

    public function withAmount(?int $amount): self
    {
        $this->double()
            ->getAmount()
            ->willReturn($amount)
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->withAmount($this->int());
    }

    protected function classNameOrInterface(): string
    {
        return Price::class;
    }

    protected function double(): ObjectProphecy|Price
    {
        return $this->double;
    }
}
