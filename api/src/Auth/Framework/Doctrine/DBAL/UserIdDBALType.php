<?php

declare(strict_types=1);

namespace App\Auth\Framework\Doctrine\DBAL;

use App\Auth\Domain\Model\UserId;
use PlanB\Framework\Doctrine\DBAL\Type\EntityIdType;

final class UserIdDBALType extends EntityIdType
{
	public function makeFromValue(string $value): UserId
	{
		return new UserId($value);
	}

	public function getName(): string
	{
		return 'Auth.UserId';
	}
}
