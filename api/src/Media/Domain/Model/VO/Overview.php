<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO;

use PlanB\Type\StringValue;
use PlanB\Validation\Traits\ValidableTrait;

final class Overview implements StringValue
{
	use ValidableTrait;
	private string $overview;

	public function __construct(string $overview)
	{
		$this->assert(overview: $overview);
		$this->overview = $overview;
	}

	public function getOverview(): string
	{
		return $this->overview;
	}

	public function __toString(): string
	{
		return $this->overview;
	}
}
