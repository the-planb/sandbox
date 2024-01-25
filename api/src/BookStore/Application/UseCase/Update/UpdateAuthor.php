<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Update;

use App\BookStore\Domain\Input\AuthorInput;
use App\BookStore\Domain\Model\AuthorId;
use App\BookStore\Domain\Model\VO\FullName;

final class UpdateAuthor
{
    private FullName $name;

    private AuthorId $id;

    public function __construct(AuthorInput $input, AuthorId $authorId)
    {
        $this->name = $input->name;

        $this->id = $authorId;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    public function getId(): AuthorId
    {
        return $this->id;
    }
}
