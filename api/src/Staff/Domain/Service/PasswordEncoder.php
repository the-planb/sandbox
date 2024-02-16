<?php

declare(strict_types=1);

namespace App\Staff\Domain\Service;

use App\Staff\Domain\Model\User;
use App\Staff\Domain\Model\VO\Password;

interface PasswordEncoder
{
    public function setPassword(Password $password): self;

    public function hash(User $user): Password;
}
