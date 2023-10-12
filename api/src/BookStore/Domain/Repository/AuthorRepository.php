<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Repository;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\AuthorId;

interface AuthorRepository
{
    public function save(Author $author): Author;

    public function delete(AuthorId $authorId): void;

    public function findById(AuthorId $authorId): ?Author;
}
