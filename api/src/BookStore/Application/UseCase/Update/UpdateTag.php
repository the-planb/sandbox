<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Update;

use App\BookStore\Application\Input\TagInput;
use App\BookStore\Domain\Model\TagId;
use App\BookStore\Domain\Model\VO\TagName;

final class UpdateTag
{
    private TagName $name;

    private TagId $id;

    public function __construct(TagInput $input, TagId $tagId)
    {
        $this->name = $input->name;

        $this->id = $tagId;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    public function getId(): TagId
    {
        return $this->id;
    }
}
