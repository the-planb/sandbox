<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Rate;

use App\Media\Application\UseCase\Update\UpdateMovie;
use App\Media\Domain\Model\Movie;
use App\Media\Domain\Repository\MovieRepository;
use PlanB\UseCase\UseCaseInterface;

final class RateMovieUseCase implements UseCaseInterface
{
    private MovieRepository $repository;

    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateMovie $command): Movie
    {
        $movieId = $command->getId();
        $previous = $this->repository->findById($movieId);

        $input = $command->toArray();

        $movie = $previous->update(...$input);

        return $this->repository->save($movie);
    }
}
