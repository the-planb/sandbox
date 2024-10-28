<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\ReviewContent;
use PlanB\Framework\Doctrine\DBAL\Type\TextType;

final class ReviewContentDBALType extends TextType
{
	public function getName(): string
	{
		return 'Media.ReviewContent';
	}

	public function getFQN(): string
	{
		return ReviewContent::class;
	}
}
