<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\Overview;
use PlanB\Framework\Doctrine\DBAL\Type\TextType;

class OverviewDBALType extends TextType
{
    public function getName(): string
    {
        return 'Media.Overview';
    }

    public function getFQN(): string
    {
        return Overview::class;
    }
}
