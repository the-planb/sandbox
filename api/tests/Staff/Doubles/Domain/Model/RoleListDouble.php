<?php

declare(strict_types=1);

namespace App\Tests\Staff\Doubles\Domain\Model;

use App\Staff\Domain\Model\RoleList;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class RoleListDouble extends Double
{
    /**
     * @var string[]
     */
    private array $items = [];

    public function reveal(): RoleList
    {
        $this->double()
            ->toArray()
            ->willReturn($this->items)
        ;

        return $this->double->reveal();
    }

    public function withItems(string ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return RoleList::class;
    }

    protected function double(): ObjectProphecy|RoleList
    {
        return $this->double;
    }
}
