<?php

declare(strict_types=1);

namespace App\Borrame\Framework\Doctrine\DBAL;

use App\Borrame\Domain\Model\VO\Role;
use PlanB\Framework\Doctrine\DBAL\Type\StringType;

final class RoleDBALType extends StringType
{
    public function getFQN(): string
    {
        return Role::class;
    }

    public function getName(): string
    {
        return 'Auth.Role';
    }
}
