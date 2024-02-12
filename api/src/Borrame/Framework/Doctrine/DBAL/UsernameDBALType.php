<?php

declare(strict_types=1);

namespace App\Borrame\Framework\Doctrine\DBAL;

use App\Borrame\Domain\Model\VO\Username;
use PlanB\Framework\Doctrine\DBAL\Type\StringType;

final class UsernameDBALType extends StringType
{
    public function getFQN(): string
    {
        return Username::class;
    }

    public function getName(): string
    {
        return 'Auth.Username';
    }
}
