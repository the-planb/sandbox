<?php

declare(strict_types=1);

namespace App\Tests\Double\Media\Domain\Model\VO;

use Faker\Factory;

final class ScoreExample
{
	public static function make(): self
	{
		return new self();
	}

	public static function dataSet(): array
	{
		$faker = Factory::create('es_ES');

		$dataSet = [
			'happy' => ['score' => 5],
		];

		return [];
	}
}
