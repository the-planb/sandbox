<?php

declare(strict_types=1);

namespace App\Music\Application\UseCase\Update;

use App\Music\Domain\Model\Disco;
use App\Music\Domain\Repository\DiscoRepository;
use PlanB\UseCase\UseCaseInterface;

final class UpdateDiscoUseCase implements UseCaseInterface
{
    private DiscoRepository $repository;

    public function __construct(DiscoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateDisco $command): Disco
    {
        $data = $command->toArray();
        $discoId = $command->getId();

        $previous = $this->repository->findById($discoId);

        $disco = $previous->update(...$data);

        return $this->repository->save($disco);
    }
}
