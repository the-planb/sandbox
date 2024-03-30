<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\FindById;

use App\Auth\Domain\Model\User;
use App\Auth\Domain\Repository\UserRepository;
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
