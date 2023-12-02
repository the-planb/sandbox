<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Repository;

use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Model\TagId;
use App\BookStore\Domain\Model\TagList;
use PlanB\Domain\Criteria\Criteria;

interface TagRepository
{
    public function save(Tag $tag): Tag;

    public function delete(TagId $tagId): void;

    public function findById(TagId $tagId): ?Tag;

    public function match(Criteria $criteria): TagList;

    public function totalItems(): int;
}
