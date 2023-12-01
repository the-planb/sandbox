<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model\VO\Constraint;

use App\BookStore\Domain\Model\VO\FullName as VO_FullName;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;

final class FullNameConstraint extends Compound
{
    public function getClassName(): string
    {
        return VO_FullName::class;
    }

    /**
     * @param mixed[] $options
     *
     * @return Constraint[]
     */
    protected function getConstraints(array $options): array
    {
        return [
            new Collection(
                fields: [
                    'firstName' => new Length([
                        'min' => 3,
                    ]),

                    'lastName' => new Length([
                        'min' => 3,
                    ]),
                ],
                allowExtraFields: true
            ),
        ];
    }
}
