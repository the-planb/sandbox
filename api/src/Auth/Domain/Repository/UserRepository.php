<?php

declare(strict_types=1);

namespace App\Auth\Domain\Repository;

use App\Auth\Domain\Model\User;
use App\Auth\Domain\Model\UserId;
use App\Auth\Domain\Model\UserList;
use PlanB\Domain\Criteria\Criteria;

interface UserRepository
{
    public function save(User $user): User;

    public function delete(UserId $userId): void;

    public function findById(UserId $userId): ?User;

    public function match(Criteria $criteria): UserList;

    public function totalItems(Criteria $criteria): int;
}
