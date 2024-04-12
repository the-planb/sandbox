<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO\Constraint;

use App\Media\Domain\Model\VO\MovieTitle;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

final class MovieTitleConstraint extends Compound
{
    public function getClassName(): string
    {
        return MovieTitle::class;
    }

    /**
     * @param mixed[] $options
     *
     * @return Constraint[]
     */
    public function getConstraints(array $options): array
    {
        return [
            new Type('string'),
            new Length([
                'min' => 3,
            ]),
        ];
    }
}