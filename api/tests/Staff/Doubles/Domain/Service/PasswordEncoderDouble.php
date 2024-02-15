<?php

declare(strict_types=1);

namespace App\Tests\Staff\Doubles\Domain\Service;

use App\Staff\Domain\Service\PasswordEncoder;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class PasswordEncoderDouble extends Double
{
    public function reveal(): PasswordEncoder
    {
        return $this->double->reveal();
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
