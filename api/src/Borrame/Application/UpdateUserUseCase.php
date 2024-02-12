<?php

declare(strict_types=1);

namespace App\Borrame\Application;

use App\Borrame\Application\Transformer\UserTransformer;
use App\Borrame\Domain\Model\User;
use App\Borrame\Domain\Repository\UserRepository;
use PlanB\UseCase\UseCaseInterface;

final class UpdateUserUseCase implements UseCaseInterface
{
    private UserTransformer $transformer;
    private UserRepository $repository;

    public function __construct(UserTransformer $transformer, UserRepository $repository)
    {
        $this->transformer = $transformer;
        $this->repository = $repository;
    }

    public function __invoke(UpdateUser $command): User
    {
        $input = $command->getInput();
        $previous = $this->repository->findById($command->getId());

        $user = $this->transformer->update($previous, $input);

        $this->repository->save($user);

        return $user;
    }
}
