<?php

declare(strict_types=1);

namespace App\Auth\Domain\Service;

use App\Auth\Domain\Model\User;
use App\Auth\Domain\Model\VO\Password;

interface PasswordEncoder
{
	public function setPassword(Password $password): self;

	public function hash(User $user): Password;
}
