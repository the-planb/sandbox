<?php

declare(strict_types=1);

namespace App\Staff\Application\UseCase\Create;

use App\Staff\Domain\Model\User;
use App\Staff\Domain\Repository\UserRepository;
use App\Staff\Domain\Service\PasswordEncoder;
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
