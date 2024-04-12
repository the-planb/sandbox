<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\Overview;
use PlanB\Framework\Doctrine\DBAL\Type\TextType;

final class OverviewDBALType extends TextType
{
    public function getFQN(): string
    {
        return Overview::class;
    }

    public function getName(): string
    {
        return 'Media.Overview';
    }
}
