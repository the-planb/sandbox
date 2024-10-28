<?php

declare(strict_types=1);

namespace PlanB\Framework\Testing\DataLoader;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Map\Map;

/**
 * @extends Map<string, TestData>
 */
#[ElementType(TestData::class)]
final class TestDataList extends Map
{
	public function filterByClassName(string $className)
	{
		return $this
			->filter(function (TestData $_, string $key) use ($className) {
				return $this->classNameOf($key) === $className;
			})
			->mapKeys(fn (TestData $_, string $key) => $this->keyOf($key))
		;
	}

	private function classNameOf(string $key): string
	{
		$position = strpos($key, '#');

		return $position ?
			substr($key, 0, $position) :
			$key;
	}

	private function keyOf(string $key): string
	{
		$position = strpos($key, '#');

		return $position ?
			substr($key, $position + 1, strlen($key) - $position) :
			$key;
	}
}
