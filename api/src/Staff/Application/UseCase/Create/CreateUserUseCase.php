<?php

declare(strict_types=1);

namespace App\Staff\Application\UseCase\Create;

use App\Staff\Domain\Model\User;
use App\Staff\Domain\Repository\UserRepository;
use PlanB\UseCase\UseCaseInterface;

final class CreateUserUseCase implements UseCaseInterface
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateUser $command): User
    {
        $input = $command->toArray();
        $user = new User(...$input);

        return $this->repository->save($user);
    }
}
