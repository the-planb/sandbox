<?php

declare(strict_types=1);

namespace App\Borrame\Framework\Doctrine\DBAL;

use App\Borrame\Domain\Model\RoleList;
use PlanB\Framework\Doctrine\DBAL\Type\ArrayType;

final class RolesDBALType extends ArrayType
{
    public function getFQN(): string
    {
        return RoleList::class;
    }

    public function getName(): string
    {
        return 'Auth.Roles';
    }
}
