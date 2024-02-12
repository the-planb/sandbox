<?php

declare(strict_types=1);

namespace App\Borrame\Domain\Repository;

use App\Borrame\Domain\Model\User;
use App\Borrame\Domain\Model\UserId;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

interface UserRepository extends UserLoaderInterface
{
    public function save(User $user): void;

    public function delete(UserId $user): void;

    public function findById(UserId $userId): ?User;
}
