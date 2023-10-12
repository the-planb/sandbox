<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Delete;

use App\BookStore\Domain\Repository\AuthorRepository;
use PlanB\UseCase\UseCaseInterface;

final class DeleteAuthorUseCase implements UseCaseInterface
{
    private AuthorRepository $repository;

    public function __construct(AuthorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DeleteAuthor $command): void
    {
        $authorId = $command->getId();
        $this->repository->delete($authorId);
    }
}
