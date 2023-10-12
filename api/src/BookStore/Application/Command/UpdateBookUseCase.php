<?php

declare(strict_types=1);

namespace App\BookStore\Application\Command;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Repository\BookRepository;
use PlanB\UseCase\UseCaseInterface;

final class UpdateBookUseCase implements UseCaseInterface
{
    private BookRepository $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateBook $command): Book
    {
        $data = $command->toArray();
        $bookId = $command->getId();

        $previous = $this->repository->findById($bookId);

        $book = $previous->update(...$data);

        return $this->repository->save($book);
    }
}
