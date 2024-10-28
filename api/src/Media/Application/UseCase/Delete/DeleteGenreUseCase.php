<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Delete;

use App\Media\Domain\Repository\GenreRepository;
use PlanB\UseCase\UseCaseInterface;

final class DeleteGenreUseCase implements UseCaseInterface
{
	private GenreRepository $repository;

	public function __construct(GenreRepository $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(DeleteGenre $command): void
	{
		$genreId = $command->getId();
		$this->repository->delete($genreId);
	}
}
