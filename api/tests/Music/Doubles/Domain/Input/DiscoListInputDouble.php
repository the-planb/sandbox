<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Input;

use App\Music\Domain\Input\DiscoInput;
use App\Music\Domain\Input\DiscoListInput;
use App\Music\Domain\Model\Disco;
use PlanB\Framework\Testing\Double;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

final class DiscoListInputDouble extends Double
{
    /**
     * @var Disco|DiscoInput[]
     */
    private array $items = [];

    public function reveal(): DiscoListInput
    {
        $this->double()
            ->with(Argument::any())
            ->willReturn($this->items)
        ;

        $this->double()
            ->toArray()
            ->willReturn($this->items)
        ;

        return $this->double->reveal();
    }

    public function withItems(Disco|DiscoInput ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return DiscoListInput::class;
    }

    protected function double(): ObjectProphecy|DiscoListInput
    {
        return $this->double;
    }
}
