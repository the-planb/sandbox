<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\Create;

use App\Auth\Domain\Model\User;
use App\Auth\Domain\Repository\UserRepository;
use App\Auth\Domain\Service\PasswordEncoder;
use PlanB\UseCase\UseCaseInterface;

final class CreateUserUseCase implements UseCaseInterface
{
    private UserRepository $repository;
    private PasswordEncoder $encoder;

    public function __construct(PasswordEncoder $encoder, UserRepository $repository)
    {
        $this->encoder = $encoder;
        $this->repository = $repository;
    }

    public function __invoke(CreateUser $command): User
    {
        $input = $command->toArray();

        $input['encoder'] = $this->encoder->setPassword($input['password']);
        unset($input['password']);

        $user = new User(...$input);

        return $this->repository->save($user);
    }
}
