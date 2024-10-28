<?php

declare(strict_types=1);

namespace PlanB\Framework\Testing\Native;

final class IntegerDummy
{
	public function between(int $min, int $max): int
	{
		return rand($min, $max);
	}

	public function positive(): int
	{
		return $this->between(1, PHP_INT_MAX - 1);
	}

	public function nonPositive(): int
	{
		return $this->between(PHP_INT_MIN, 0);
	}

	public function negative(): int
	{
		return $this->between(PHP_INT_MIN, -1);
	}

	public function nonNegative(): int
	{
		return $this->between(0, PHP_INT_MAX - 1);
	}

	public function dummy(): int
	{
		return 10;
	}
}
