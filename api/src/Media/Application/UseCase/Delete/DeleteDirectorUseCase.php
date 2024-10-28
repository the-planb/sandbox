<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Delete;

use App\Media\Domain\Repository\DirectorRepository;
use PlanB\UseCase\UseCaseInterface;

final class DeleteDirectorUseCase implements UseCaseInterface
{
	private DirectorRepository $repository;

	public function __construct(DirectorRepository $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(DeleteDirector $command): void
	{
		$directorId = $command->getId();
		$this->repository->delete($directorId);
	}
}
