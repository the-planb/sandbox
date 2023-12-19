<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\FindById;

use App\BookStore\Domain\Model\AuthorId;

final class FindAuthorById
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
