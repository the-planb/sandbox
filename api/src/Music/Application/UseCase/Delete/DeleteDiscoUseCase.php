<?php

declare(strict_types=1);

namespace App\Music\Application\UseCase\Delete;

use App\Music\Domain\Repository\DiscoRepository;
use PlanB\UseCase\UseCaseInterface;

final class DeleteDiscoUseCase implements UseCaseInterface
{
    private DiscoRepository $repository;

    public function __construct(DiscoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DeleteDisco $command): void
    {
        $discoId = $command->getId();
        $this->repository->delete($discoId);
    }
}
