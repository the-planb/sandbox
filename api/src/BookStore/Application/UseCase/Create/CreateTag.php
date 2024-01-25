<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Create;

use App\BookStore\Domain\Input\TagInput;
use App\BookStore\Domain\Model\VO\TagName;

final class CreateTag
{
    private TagName $name;

    public function __construct(TagInput $input)
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
