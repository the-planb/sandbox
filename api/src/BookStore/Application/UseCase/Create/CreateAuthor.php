<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Create;

use App\BookStore\Application\Input\AuthorInput;
use App\BookStore\Domain\Model\VO\FullName;

final class CreateAuthor
{
    private FullName $name;

    public function __construct(AuthorInput $input)
    {
        $this->name = $input->name;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
