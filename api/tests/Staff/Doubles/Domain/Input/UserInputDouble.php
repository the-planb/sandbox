<?php

declare(strict_types=1);

namespace App\Tests\Staff\Doubles\Domain\Input;

use App\Staff\Domain\Input\UserInput;
use App\Staff\Domain\Model\UserId;
use App\Staff\Domain\Model\VO\Email;
use App\Staff\Domain\Model\VO\UserName;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class UserInputDouble extends Double
{
    private UserInput $input;

    public function __construct(callable $prophesize, callable $configurator = null)
    {
        $this->input = new UserInput();
        parent::__construct($prophesize, $configurator);
    }

    public function reveal(): UserInput
    {
        return $this->input;
    }

    public function withId(UserId $id): self
    {
        $this->double()
            ->id = $id
        ;

        return $this;
    }

    public function withName(UserName $name): self
    {
        $this->double()
            ->name = $name
        ;

        return $this;
    }

    public function withEmail(Email $email): self
    {
        $this->double()
            ->email = $email
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->double()->name = $this->mock(UserName::class)->reveal();

        $this->double()->email = $this->mock(Email::class)->reveal();
    }

    protected function classNameOrInterface(): string
    {
        return UserInput::class;
    }

    protected function double(): ObjectProphecy|UserInput
    {
        return $this->input;
    }
}
