<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\FindById;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Repository\AuthorRepository;
use PlanB\UseCase\UseCaseInterface;

final class FindAuthorByIdUseCase implements UseCaseInterface
{
    private AuthorRepository $repository;

    public function __construct(AuthorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindAuthorById $command): ?Author
    {
        $authorId = $command->getId();

        return $this->repository->findById($authorId);
    }
}
