<?php

declare(strict_types=1);

namespace App\Staff\Application\UseCase\Search;

use App\Staff\Domain\Repository\UserRepository;
use PlanB\UseCase\UseCaseInterface;

final class SearchUserUseCase implements UseCaseInterface
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SearchUser $command): array
    {
        $criteria = $command->getCriteria();

        return $this->repository->match($criteria)->toArray();
    }
}
