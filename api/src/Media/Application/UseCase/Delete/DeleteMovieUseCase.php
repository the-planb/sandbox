<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Delete;

use App\Media\Domain\Repository\MovieRepository;
use PlanB\UseCase\UseCaseInterface;

final class DeleteMovieUseCase implements UseCaseInterface
{
	private MovieRepository $repository;

	public function __construct(MovieRepository $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(DeleteMovie $command): void
	{
		$movieId = $command->getId();
		$this->repository->delete($movieId);
	}
}
