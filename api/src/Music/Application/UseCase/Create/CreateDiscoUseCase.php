<?php

declare(strict_types=1);

namespace App\Music\Application\UseCase\Create;

use App\Music\Domain\Model\Disco;
use App\Music\Domain\Repository\DiscoRepository;
use PlanB\UseCase\UseCaseInterface;

final class CreateDiscoUseCase implements UseCaseInterface
{
    private DiscoRepository $repository;

    public function __construct(DiscoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateDisco $command): Disco
    {
        $input = $command->toArray();
        $disco = new Disco(...$input);

        return $this->repository->save($disco);
    }
}
