<?php

declare(strict_types=1);

namespace App\Music\Domain\Model\VO\Constraint;

use App\Music\Domain\Model\VO\DiscoName as VO_DiscoName;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Length;

final class DiscoNameConstraint extends Compound
{
    public function getClassName(): string
    {
        return VO_DiscoName::class;
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
                'min' => 5,
            ]),
        ];
    }
}
