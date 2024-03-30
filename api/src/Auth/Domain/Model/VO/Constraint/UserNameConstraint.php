<?php

declare(strict_types=1);

namespace App\Auth\Domain\Model\VO\Constraint;

use App\Auth\Domain\Model\VO\UserName as VO_UserName;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Length;

final class UserNameConstraint extends Compound
{
    public function getClassName(): string
    {
        return VO_UserName::class;
    }

    /**
     * @param mixed[] $options
     *
     * @return Constraint[]
     */
    protected function getConstraints(array $options): array
    {
        return [
            new Length([
                'min' => 3,
            ]),
        ];
    }
}
