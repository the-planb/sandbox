<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO\Constraint;

use App\Media\Domain\Model\VO\Overview;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints\Length;

final class OverviewConstraint extends Compound
{
    public function getClassName(): string
    {
        return Overview::class;
    }

    public function getConstraints(array $options): array
    {
        return [
            new Length(['min' => 10]),
        ];
    }
}
