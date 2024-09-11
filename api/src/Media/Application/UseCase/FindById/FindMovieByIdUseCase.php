<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\FindById;

use App\Media\Domain\Model\Movie;
use App\Media\Domain\Repository\MovieRepository;
use PlanB\UseCase\UseCaseInterface;

class FindMovieByIdUseCase implements UseCaseInterface
{
    private MovieRepository $repository;

    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindMovieById $command): Movie
    {
        $movieId = $command->getId();

        return $this->repository->findById($movieId);
    }
}
