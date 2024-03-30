<?php

declare(strict_types=1);

namespace App\Movies\Framework\Doctrine\DBAL;

use App\Movies\Domain\Model\VO\Title;
use PlanB\Framework\Doctrine\DBAL\Type\StringType;

final class TitleDBALType extends StringType
{
    public function getFQN(): string
    {
        return Title::class;
    }

    public function getName(): string
    {
        return 'Movies.Title';
    }
}
