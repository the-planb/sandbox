<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Update;

use App\Media\Domain\Model\Movie;
use App\Media\Domain\Repository\MovieRepository;
use App\Media\Domain\Service\RateCalculator;
use PlanB\UseCase\UseCaseInterface;

final class UpdateMovieUseCase implements UseCaseInterface
{
    private MovieRepository $repository;
    private RateCalculator $rateCalculator;

    public function __construct(MovieRepository $repository, RateCalculator $rateCalculator)
    {
        $this->repository = $repository;
        $this->rateCalculator = $rateCalculator;
    }

    public function __invoke(UpdateMovie $command): Movie
    {
        $movieId = $command->getId();
        $previous = $this->repository->findById($movieId);
        $input = $command->toArray();
        $movie = $previous->update(...$input);
        $movie->updateScore($command->raw, $this->rateCalculator);

        return $this->repository->save($movie);
    }
}
