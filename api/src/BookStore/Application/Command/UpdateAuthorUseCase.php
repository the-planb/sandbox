<?php

declare(strict_types=1);

namespace App\BookStore\Application\Command;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Repository\AuthorRepository;
use PlanB\UseCase\UseCaseInterface;

final class UpdateAuthorUseCase implements UseCaseInterface
{
    private AuthorRepository $repository;

    public function __construct(AuthorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateAuthor $command): Author
    {
        $data = $command->toArray();
        $authorId = $command->getId();

        $previous = $this->repository->findById($authorId);

        $author = $previous->update(...$data);

        return $this->repository->save($author);
    }
}
