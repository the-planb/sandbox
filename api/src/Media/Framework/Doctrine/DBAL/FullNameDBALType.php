<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\FullName;
use PlanB\Framework\Doctrine\DBAL\Type\StringType;

final class FullNameDBALType extends StringType
{
    public function getFQN(): string
    {
        return FullName::class;
    }

    public function getName(): string
    {
        return 'Media.FullName';
    }
}
