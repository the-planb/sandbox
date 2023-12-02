<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Delete;

use App\BookStore\Domain\Model\TagId;

final class DeleteTag
{
    private TagId $tagId;

    public function __construct(TagId $tagId)
    {
        $this->tagId = $tagId;
    }

    public function getId(): TagId
    {
        return $this->tagId;
    }
}
