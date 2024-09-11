<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO\Constraint;

use App\Media\Domain\Model\VO\FullName;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

class FullNameConstraint extends Compound
{
    public function getClassName(): string
    {
        return FullName::class;
    }

    public function getConstraints(array $options): array
    {
        return [
            new Collection([
                'fields' => [
                    'name' => [
                        new Type('string'),
                        new Length(['min' => 3]),
                    ],
                    'lastName' => [
                        new Type('string'),
                        new Length(['min' => 3]),
                    ],
                ],
                'allowExtraFields' => false,
            ]),
        ];
    }
}
