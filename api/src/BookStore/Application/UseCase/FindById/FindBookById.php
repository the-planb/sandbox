<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\FindById;

use App\BookStore\Domain\Model\BookId;

final class FindBookById
{
    private BookId $bookId;

    public function __construct(BookId $bookId)
    {
        $this->bookId = $bookId;
    }

    public function getId(): BookId
    {
        return $this->bookId;
    }
}
