<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\Fixtures;

use App\Media\Application\UseCase\Create\CreateGenre;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;
use Symfony\Component\Yaml\Yaml;

final class GenreFixture extends UseCaseFixture
{
	public function loadData(): void
	{
		$data = Yaml::parseFile(__DIR__.'/data/genres.yaml');
		$this->createRange($data, function (array $input) {
			$command = $this->denormalize([
				'name' => $input['name'],
			], CreateGenre::class);

			return $this->handle($command);
		});
	}

	public function getDependencies()
	{
		return [
		];
	}
}
