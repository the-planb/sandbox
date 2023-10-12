<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Search;

use App\BookStore\Domain\Repository\BookRepository;
use PlanB\UseCase\UseCaseInterface;

final class SearchBookUseCase implements UseCaseInterface
{
    private BookRepository $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SearchBook $command): array
    {
        $criteria = $command->getCriteria();

        return $this->repository->match($criteria)->toArray();
    }
}
