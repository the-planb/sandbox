<?php

declare(strict_types=1);

namespace App\BookStore\Application\Command;

use App\BookStore\Application\Input\AuthorInput;
use App\BookStore\Domain\Model\AuthorId;
use App\BookStore\Domain\Model\VO\FullName;

final class UpdateAuthor
{
    private FullName $name;
    private AuthorId $__previous_id;

    public function __construct(AuthorInput $input, AuthorId $authorId)
    {
        $this->name = $input->name;

        $this->__previous_id = $authorId;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    public function getId(): AuthorId
    {
        return $this->__previous_id;
    }
}
