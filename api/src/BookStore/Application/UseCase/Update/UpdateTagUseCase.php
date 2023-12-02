<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Update;

use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Repository\TagRepository;
use PlanB\UseCase\UseCaseInterface;

final class UpdateTagUseCase implements UseCaseInterface
{
    private TagRepository $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateTag $command): Tag
    {
        $data = $command->toArray();
        $tagId = $command->getId();

        $previous = $this->repository->findById($tagId);

        $tag = $previous->update(...$data);

        return $this->repository->save($tag);
    }
}
