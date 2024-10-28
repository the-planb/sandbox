<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\ReviewId;
use PlanB\Framework\Doctrine\DBAL\Type\EntityIdType;

final class ReviewIdDBALType extends EntityIdType
{
	public function makeFromValue(string $value): ReviewId
	{
		return new ReviewId($value);
	}

	public function getName(): string
	{
		return 'Media.ReviewId';
	}
}
