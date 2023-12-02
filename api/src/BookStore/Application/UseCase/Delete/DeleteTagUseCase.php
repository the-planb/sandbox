<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Delete;

use App\BookStore\Domain\Repository\TagRepository;
use PlanB\UseCase\UseCaseInterface;

final class DeleteTagUseCase implements UseCaseInterface
{
    private TagRepository $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DeleteTag $command): void
    {
        $tagId = $command->getId();
        $this->repository->delete($tagId);
    }
}
