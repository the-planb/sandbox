<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\Fixtures;

use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

final class MediaTestDataFixture extends UseCaseFixture
{
	public function loadData(): void
	{
		//		$this->loadSqlFile(__DIR__.'/sql/data_test.sql');
	}

	public function allowedEnvironments(): array
	{
		return ['test'];
	}
}
