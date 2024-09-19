<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO\Constraint;

use App\Media\Domain\Model\VO\GenreName;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints\Length;

final class GenreNameConstraint extends Compound
{
    public function getClassName(): string
    {
        return GenreName::class;
    }

    public function getConstraints(array $options): array
    {
        return [
            new Length(['min' => 3]),
        ];
    }
}
