<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO\Constraint;

use App\Media\Domain\Model\VO\Classification;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints\Choice;

class ClassificationConstraint extends Compound
{
    public function getClassName(): string
    {
        return Classification::class;
    }

    public function getConstraints(array $options): array
    {
        return [
            new Choice([
                'choices' => [
                    'G',
                    'PG',
                    'PG_13',
                    'R',
                    'NC_17',
                ],
                'message' => 'The value you selected is not a valid choice. [G|PG|PG_13|R|NC_17]',
            ]),
        ];
    }
}
