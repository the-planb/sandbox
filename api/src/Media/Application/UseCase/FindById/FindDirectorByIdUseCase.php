<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\FindById;

use App\Media\Domain\Model\Director;
use App\Media\Domain\Repository\DirectorRepository;
use PlanB\UseCase\UseCaseInterface;

final class FindDirectorByIdUseCase implements UseCaseInterface
{
	private DirectorRepository $repository;

	public function __construct(DirectorRepository $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(FindDirectorById $command): Director
	{
		$directorId = $command->getId();

		return $this->repository->findById($directorId);
	}
}
