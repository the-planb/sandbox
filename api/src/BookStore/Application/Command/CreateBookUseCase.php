<?php

declare(strict_types=1);

namespace App\BookStore\Application\Command;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Repository\BookRepository;
use PlanB\UseCase\UseCaseInterface;

final class CreateBookUseCase implements UseCaseInterface
{
    private BookRepository $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateBook $command): Book
    {
        $input = $command->toArray();
        $book = new Book(...$input);

        return $this->repository->save($book);
    }
}
