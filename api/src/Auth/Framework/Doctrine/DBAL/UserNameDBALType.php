<?php

declare(strict_types=1);

namespace App\Auth\Framework\Doctrine\DBAL;

use App\Auth\Domain\Model\VO\UserName;
use PlanB\Framework\Doctrine\DBAL\Type\StringType;

final class UserNameDBALType extends StringType
{
    public function getFQN(): string
    {
        return UserName::class;
    }

    public function getName(): string
    {
        return 'Auth.UserName';
    }
}
