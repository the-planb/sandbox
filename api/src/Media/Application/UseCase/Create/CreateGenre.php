<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Create;

use App\Media\Domain\Model\VO\GenreName;

class CreateGenre
{
	public GenreName $name;

	public function toArray(): array
	{
		return [
			'name' => $this->name,
		];
	}
}
