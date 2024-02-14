<?php

declare(strict_types=1);

namespace App\Staff\Application\UseCase\Delete;

use App\Staff\Domain\Model\UserId;

final class DeleteUser
{
    private UserId $userId;

    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    public function getId(): UserId
    {
        return $this->userId;
    }
}
