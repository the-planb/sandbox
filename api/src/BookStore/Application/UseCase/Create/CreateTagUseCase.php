<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Create;

use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Repository\TagRepository;
use PlanB\UseCase\UseCaseInterface;

final class CreateTagUseCase implements UseCaseInterface
{
    private TagRepository $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateTag $command): Tag
    {
        $input = $command->toArray();
        $tag = new Tag(...$input);

        return $this->repository->save($tag);
    }
}
