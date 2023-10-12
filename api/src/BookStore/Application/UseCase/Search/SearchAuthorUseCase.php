<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Search;

use App\BookStore\Domain\Repository\AuthorRepository;
use PlanB\UseCase\UseCaseInterface;

final class SearchAuthorUseCase implements UseCaseInterface
{
    private AuthorRepository $repository;

    public function __construct(AuthorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SearchAuthor $command): array
    {
        $criteria = $command->getCriteria();

        return $this->repository->match($criteria)->toArray();
    }
}
