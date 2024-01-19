<?php

declare(strict_types=1);

namespace App\Music\Domain\Model\VO\Constraint;

use App\Music\Domain\Model\VO\Duration as VO_Duration;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\GreaterThan;

final class DurationConstraint extends Compound
{
    public function getClassName(): string
    {
        return VO_Duration::class;
    }

    /**
     * @param mixed[] $options
     *
     * @return Constraint[]
     */
    protected function getConstraints(array $options): array
    {
        return [
            new GreaterThan([
                'value' => 0,
            ]),
        ];
    }
}
