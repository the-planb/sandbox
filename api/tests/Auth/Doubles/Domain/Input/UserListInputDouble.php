<?php

declare(strict_types=1);

namespace App\Tests\Auth\Doubles\Domain\Input;

use App\Auth\Domain\Input\UserInput;
use App\Auth\Domain\Input\UserListInput;
use App\Auth\Domain\Model\User;
use PlanB\Framework\Testing\Double;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

final class UserListInputDouble extends Double
{
    /**
     * @var User|UserInput[]
     */
    private array $items = [];

    public function reveal(): UserListInput
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

    public function withItems(User|UserInput ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return UserListInput::class;
    }

    protected function double(): ObjectProphecy|UserListInput
    {
        return $this->double;
    }
}
