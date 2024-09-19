<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\MovieTitle;
use PlanB\Framework\Doctrine\DBAL\Type\StringType;

final class MovieTitleDBALType extends StringType
{
    public function getName(): string
    {
        return 'Media.MovieTitle';
    }

    public function getFQN(): string
    {
        return MovieTitle::class;
    }
}
