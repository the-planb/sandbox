<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\Delete;

use App\Auth\Domain\Repository\UserRepository;
use PlanB\UseCase\UseCaseInterface;

final class DeleteUserUseCase implements UseCaseInterface
{
	private UserRepository $repository;

	public function __construct(UserRepository $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(DeleteUser $command): void
	{
		$userId = $command->getId();
		$this->repository->delete($userId);
	}
}
