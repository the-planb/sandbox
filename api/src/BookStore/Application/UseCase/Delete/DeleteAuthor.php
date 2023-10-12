<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Delete;

use App\BookStore\Domain\Model\AuthorId;

final class DeleteAuthor
{
    private AuthorId $authorId;

    public function __construct(AuthorId $authorId)
    {
        $this->authorId = $authorId;
    }

    public function getId(): AuthorId
    {
        return $this->authorId;
    }
}
