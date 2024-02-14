<?php

declare(strict_types=1);

namespace App\Staff\Application\UseCase\Update;

use App\Staff\Domain\Model\User;
use App\Staff\Domain\Repository\UserRepository;
use PlanB\UseCase\UseCaseInterface;

final class UpdateUserUseCase implements UseCaseInterface
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateUser $command): User
    {
        $data = $command->toArray();
        $userId = $command->getId();

        $previous = $this->repository->findById($userId);

        $user = $previous->update(...$data);

        return $this->repository->save($user);
    }
}
