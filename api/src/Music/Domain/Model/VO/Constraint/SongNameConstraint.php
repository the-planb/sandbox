<?php

declare(strict_types=1);

namespace App\Music\Domain\Model\VO\Constraint;

use App\Music\Domain\Model\VO\SongName as VO_SongName;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Length;

final class SongNameConstraint extends Compound
{
    public function getClassName(): string
    {
        return VO_SongName::class;
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
