<?php

declare(strict_types=1);

namespace App\Staff\Application\UseCase\FindById;

use App\Staff\Domain\Model\User;
use App\Staff\Domain\Repository\UserRepository;
use PlanB\UseCase\UseCaseInterface;

final class FindUserByIdUseCase implements UseCaseInterface
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindUserById $command): ?User
    {
        $userId = $command->getId();

        return $this->repository->findById($userId);
    }
}
