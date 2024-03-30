<?php

declare(strict_types=1);

namespace App\Auth\Framework\Doctrine\DBAL;

use App\Auth\Domain\Model\VO\Password;
use PlanB\Framework\Doctrine\DBAL\Type\StringType;

final class PasswordDBALType extends StringType
{
    public function getFQN(): string
    {
        return Password::class;
    }

    public function getName(): string
    {
        return 'Auth.Password';
    }
}
