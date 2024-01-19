<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Model;

use App\Music\Domain\Model\Disco;
use App\Music\Domain\Model\DiscoList;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class DiscoListDouble extends Double
{
    /**
     * @var Disco[]
     */
    private array $items = [];

    public function reveal(): DiscoList
    {
        $this->double()
            ->toArray()
            ->willReturn($this->items)
        ;

        return $this->double->reveal();
    }

    public function withItems(Disco ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return DiscoList::class;
    }

    protected function double(): ObjectProphecy|DiscoList
    {
        return $this->double;
    }
}
