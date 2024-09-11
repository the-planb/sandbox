<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Create;

use App\Media\Domain\Model\Genre;
use App\Media\Domain\Repository\GenreRepository;
use PlanB\UseCase\UseCaseInterface;

class CreateGenreUseCase implements UseCaseInterface
{
    private GenreRepository $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateGenre $command): Genre
    {
        $input = $command->toArray();

        $genre = new Genre(...$input);

        return $this->repository->save($genre);
    }
}
