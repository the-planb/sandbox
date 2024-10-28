<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\DirectorId;
use PlanB\Framework\Doctrine\DBAL\Type\EntityIdType;

final class DirectorIdDBALType extends EntityIdType
{
	public function makeFromValue(string $value): DirectorId
	{
		return new DirectorId($value);
	}

	public function getName(): string
	{
		return 'Media.DirectorId';
	}
}
