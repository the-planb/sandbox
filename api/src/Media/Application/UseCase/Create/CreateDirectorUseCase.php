<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Create;

use App\Media\Domain\Model\Director;
use App\Media\Domain\Repository\DirectorRepository;
use PlanB\UseCase\UseCaseInterface;

final class CreateDirectorUseCase implements UseCaseInterface
{
    private DirectorRepository $repository;

    public function __construct(DirectorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateDirector $command): Director
    {
        $input = $command->toArray();

        $director = new Director(...$input);

        return $this->repository->save($director);
    }
}
