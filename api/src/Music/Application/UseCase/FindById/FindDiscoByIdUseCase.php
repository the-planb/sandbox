<?php

declare(strict_types=1);

namespace App\Music\Application\UseCase\FindById;

use App\Music\Domain\Model\Disco;
use App\Music\Domain\Repository\DiscoRepository;
use PlanB\UseCase\UseCaseInterface;

final class FindDiscoByIdUseCase implements UseCaseInterface
{
    private DiscoRepository $repository;

    public function __construct(DiscoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindDiscoById $command): ?Disco
    {
        $discoId = $command->getId();

        return $this->repository->findById($discoId);
    }
}
