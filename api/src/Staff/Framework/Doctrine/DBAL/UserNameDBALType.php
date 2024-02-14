<?php

declare(strict_types=1);

namespace App\Staff\Framework\Doctrine\DBAL;

use App\Staff\Domain\Model\VO\UserName;
use PlanB\Framework\Doctrine\DBAL\Type\StringType;

final class UserNameDBALType extends StringType
{
    public function getFQN(): string
    {
        return UserName::class;
    }

    public function getName(): string
    {
        return 'Staff.UserName';
    }
}
