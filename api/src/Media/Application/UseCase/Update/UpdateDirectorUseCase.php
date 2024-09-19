<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Update;

use App\Media\Domain\Model\Director;
use App\Media\Domain\Repository\DirectorRepository;
use PlanB\UseCase\UseCaseInterface;

final class UpdateDirectorUseCase implements UseCaseInterface
{
    private DirectorRepository $repository;

    public function __construct(DirectorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateDirector $command): Director
    {
        $directorId = $command->getId();
        $previous = $this->repository->findById($directorId);
        $input = $command->toArray();
        $director = $previous->update(...$input);

        return $this->repository->save($director);
    }
}
