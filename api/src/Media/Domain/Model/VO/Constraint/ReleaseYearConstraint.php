<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO\Constraint;

use App\Media\Domain\Model\VO\ReleaseYear;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Type;

final class ReleaseYearConstraint extends Compound
{
    public function getClassName(): string
    {
        return ReleaseYear::class;
    }

    /**
     * @param mixed[] $options
     *
     * @return Constraint[]
     */
    public function getConstraints(array $options): array
    {
        return [
            new Type('int'),
            new Range([
                'min' => 1900,
            ]),
        ];
    }
}
