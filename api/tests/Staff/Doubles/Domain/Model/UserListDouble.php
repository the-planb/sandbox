<?php

declare(strict_types=1);

namespace App\Tests\Staff\Doubles\Domain\Model;

use App\Staff\Domain\Model\User;
use App\Staff\Domain\Model\UserList;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class UserListDouble extends Double
{
    /**
     * @var User[]
     */
    private array $items = [];

    public function reveal(): UserList
    {
        $this->double()
            ->toArray()
            ->willReturn($this->items)
        ;

        return $this->double->reveal();
    }

    public function withItems(User ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return UserList::class;
    }

    protected function double(): ObjectProphecy|UserList
    {
        return $this->double;
    }
}
