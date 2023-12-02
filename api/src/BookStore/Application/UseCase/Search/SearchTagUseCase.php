<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Search;

use App\BookStore\Domain\Repository\TagRepository;
use PlanB\UseCase\UseCaseInterface;

final class SearchTagUseCase implements UseCaseInterface
{
    private TagRepository $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SearchTag $command): array
    {
        $criteria = $command->getCriteria();

        return $this->repository->match($criteria)->toArray();
    }
}
