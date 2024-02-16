<?php

declare(strict_types=1);

namespace App\Tests\Staff\Doubles\Domain\Service;

use App\Staff\Domain\Model\User;
use App\Staff\Domain\Model\VO\Password;
use App\Staff\Domain\Service\PasswordEncoder;
use PlanB\Framework\Testing\Double;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

final class PasswordEncoderDouble extends Double
{
    public function reveal(): PasswordEncoder
    {
        return $this->double->reveal();
    }

    public function withHash(string $hash)
    {
        $this->double()
            ->hash(Argument::type(User::class))
            ->willReturn(new Password($hash))
        ;
    }

    protected function classNameOrInterface(): string
    {
        return PasswordEncoder::class;
    }

    protected function double(): ObjectProphecy|PasswordEncoder
    {
        return $this->double;
    }
}
