<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO\Constraint;

use App\Media\Domain\Model\VO\Score;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints\Range;

final class ScoreConstraint extends Compound
{
	public function getClassName(): string
	{
		return Score::class;
	}

	public function getConstraints(array $options): array
	{
		return [
			new Range(['min' => 0, 'max' => 10]),
		];
	}
}
