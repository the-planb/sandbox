<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Create;

use App\Media\Domain\Model\Movie;
use App\Media\Domain\Repository\MovieRepository;
use App\Media\Domain\Service\RateCalculator;
use PlanB\UseCase\UseCaseInterface;

final class CreateMovieUseCase implements UseCaseInterface
{
    private MovieRepository $repository;
    private RateCalculator $rateCalculator;

    public function __construct(MovieRepository $repository, RateCalculator $rateCalculator)
    {
        $this->repository = $repository;
        $this->rateCalculator = $rateCalculator;
    }

    public function __invoke(CreateMovie $command): Movie
    {
        $input = $command->toArray();
        $movie = new Movie(...$input);
        $movie->updateScore($command->raw, $this->rateCalculator);

        return $this->repository->save($movie);
    }
}
