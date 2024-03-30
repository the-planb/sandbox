<?php

declare(strict_types=1);

namespace App\Auth\Domain\Model\VO\Constraint;

use App\Auth\Domain\Model\VO\Password as VO_Password;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraint;

final class PasswordConstraint extends Compound
{
    public function getClassName(): string
    {
        return VO_Password::class;
    }

    /**
     * @param mixed[] $options
     *
     * @return Constraint[]
     */
    protected function getConstraints(array $options): array
    {
        return [
        ];
    }
}
