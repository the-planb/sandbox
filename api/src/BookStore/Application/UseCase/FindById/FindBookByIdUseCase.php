<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\FindById;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Repository\BookRepository;
use PlanB\UseCase\UseCaseInterface;

final class FindBookByIdUseCase implements UseCaseInterface
{
    private BookRepository $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindBookById $command): ?Book
    {
        $bookId = $command->getId();

        return $this->repository->findById($bookId);
    }
}
