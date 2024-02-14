<?php

declare(strict_types=1);

namespace App\Tests\Staff\Doubles\Domain\Model;

use App\Staff\Domain\Model\User;
use App\Staff\Domain\Model\UserId;
use App\Staff\Domain\Model\VO\Email;
use App\Staff\Domain\Model\VO\UserName;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class UserDouble extends Double
{
    public function reveal(): User
    {
        return $this->double->reveal();
    }

    public function withId(UserId $id): self
    {
        $this->double()
            ->getId()
            ->willReturn($id)
        ;

        return $this;
    }

    public function withName(UserName $name): self
    {
        $this->double()
            ->getName()
            ->willReturn($name)
        ;

        return $this;
    }

    public function withEmail(Email $email): self
    {
        $this->double()
            ->getEmail()
            ->willReturn($email)
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->withId(new UserId());
        $this->withName($this->mock(UserName::class)->reveal());

        $this->withEmail($this->mock(Email::class)->reveal());
    }

    protected function classNameOrInterface(): string
    {
        return User::class;
    }

    protected function double(): ObjectProphecy|User
    {
        return $this->double;
    }
}
