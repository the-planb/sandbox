<?php

declare(strict_types=1);

namespace App\Media\Domain\Service;

use App\Media\Domain\Model\VO\Score;
use PlanB\Domain\Exception\IncompleteMethodException;

final class RateCalculator
{
	public function __invoke(Score $raw): Score
	{
		return $raw;

		throw IncompleteMethodException::fromMethod(__METHOD__);
	}
}
