<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Delete;

use App\Media\Domain\Model\GenreId;

class DeleteGenre
{
    private GenreId $id;

    public function __construct(GenreId $id)
    {
        $this->id = $id;
    }

    public function getId(): GenreId
    {
        return $this->id;
    }
}
