<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Search;

use PlanB\Domain\Criteria\Criteria;

final class SearchDirector
{
	private Criteria $criteria;

	public function __construct(Criteria $criteria)
	{
		$this->criteria = $criteria;
	}

	public function getCriteria(): Criteria
	{
		return $this->criteria;
	}
}
