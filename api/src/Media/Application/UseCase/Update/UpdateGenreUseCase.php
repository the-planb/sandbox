<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Update;

use App\Media\Domain\Model\Genre;
use App\Media\Domain\Repository\GenreRepository;
use PlanB\UseCase\UseCaseInterface;

final class UpdateGenreUseCase implements UseCaseInterface
{
	private GenreRepository $repository;

	public function __construct(GenreRepository $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(UpdateGenre $command): Genre
	{
		$genreId = $command->getId();
		$previous = $this->repository->findById($genreId);
		$input = $command->toArray();
		$genre = $previous->update(...$input);

		return $this->repository->save($genre);
	}
}
