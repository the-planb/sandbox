<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\Classification;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use PlanB\Framework\Doctrine\DBAL\Type\EnumType;

final class ClassificationDBALType extends EnumType
{
	public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
	{
		return $platform->getStringTypeDeclarationSQL($column);
	}

	public function getName(): string
	{
		return 'Media.Classification';
	}

	public function getFQN(): string
	{
		return Classification::class;
	}
}
