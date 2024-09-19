<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\GenreName;
use PlanB\Framework\Doctrine\DBAL\Type\StringType;

final class GenreNameDBALType extends StringType
{
    public function getName(): string
    {
        return 'Media.GenreName';
    }

    public function getFQN(): string
    {
        return GenreName::class;
    }
}
