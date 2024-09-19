<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\FindById;

use App\Media\Domain\Model\Genre;
use App\Media\Domain\Repository\GenreRepository;
use PlanB\UseCase\UseCaseInterface;

final class FindGenreByIdUseCase implements UseCaseInterface
{
    private GenreRepository $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindGenreById $command): Genre
    {
        $genreId = $command->getId();

        return $this->repository->findById($genreId);
    }
}
