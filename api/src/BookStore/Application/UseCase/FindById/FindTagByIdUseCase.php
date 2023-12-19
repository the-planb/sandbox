<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\FindById;

use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Repository\TagRepository;
use PlanB\UseCase\UseCaseInterface;

final class FindTagByIdUseCase implements UseCaseInterface
{
    private TagRepository $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindTagById $command): ?Tag
    {
        $tagId = $command->getId();

        return $this->repository->findById($tagId);
    }
}
