<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO\Constraint;

use App\Media\Domain\Model\VO\ReviewContent;
use PlanB\Framework\Symfony\Validator\Constraints\Compound;

final class ReviewContentConstraint extends Compound
{
	public function getClassName(): string
	{
		return ReviewContent::class;
	}

	public function getConstraints(array $options): array
	{
		return [
		];
	}
}
