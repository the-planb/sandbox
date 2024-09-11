<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Create;

use App\Media\Domain\Model\Movie;
use App\Media\Domain\Repository\MovieRepository;
use PlanB\UseCase\UseCaseInterface;

class CreateMovieUseCase implements UseCaseInterface
{
    private MovieRepository $repository;

    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateMovie $command): Movie
    {
        $input = $command->toArray();

        $movie = new Movie(...$input);

        return $this->repository->save($movie);
    }
}
