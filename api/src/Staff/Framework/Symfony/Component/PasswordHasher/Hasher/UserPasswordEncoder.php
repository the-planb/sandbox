<?php

declare(strict_types=1);

namespace App\Staff\Framework\Symfony\Component\PasswordHasher\Hasher;

use App\Staff\Domain\Model\User;
use App\Staff\Domain\Model\VO\Password;
use App\Staff\Domain\Service\Exception\PlainPasswordMissingException;
use App\Staff\Domain\Service\PasswordEncoder;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserPasswordEncoder implements PasswordEncoder
{
    private UserPasswordHasherInterface $hasher;
    private Password $original;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function setPassword(Password $password): self
    {
        $this->original = $password;

        return $this;
    }

    public function hash(User $user): Password
    {
        if (!isset($this->original)) {
            throw new PlainPasswordMissingException();
        }

        $encoded = $this->hasher->hashPassword($user, (string) $this->original);

        return new Password($encoded);
    }
}
