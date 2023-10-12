<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Delete;

use App\BookStore\Domain\Repository\BookRepository;
use PlanB\UseCase\UseCaseInterface;

final class DeleteBookUseCase implements UseCaseInterface
{
    private BookRepository $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DeleteBook $command): void
    {
        $bookId = $command->getId();
        $this->repository->delete($bookId);
    }
}
