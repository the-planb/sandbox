<?php

declare(strict_types=1);

namespace App\Staff\Framework\Doctrine\DBAL;

use App\Staff\Domain\Model\RoleList;
use PlanB\Framework\Doctrine\DBAL\Type\ArrayType;

final class RoleListDBALType extends ArrayType
{
    public function getFQN(): string
    {
        return RoleList::class;
    }

    public function getName(): string
    {
        return 'Staff.RoleList';
    }
}
