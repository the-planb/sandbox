<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO\Constraint;

use App\Media\Domain\Model\VO\Classification;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints\Choice;

final class ClassificationConstraint extends Compound
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
                    'General Audiences',
                    'Parental Guidance Suggested',
                    'Parents Strongly Cautioned',
                    'Restricted',
                    'Adults Only',
                ],
                'message' => "The value you selected is not a valid choice. ['General Audiences'|'Parental Guidance Suggested'|'Parents Strongly Cautioned'|'Restricted'|'Adults Only']",
            ]),
        ];
    }
}
