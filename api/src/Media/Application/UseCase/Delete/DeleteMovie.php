<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Delete;

use App\Media\Domain\Model\MovieId;

class DeleteMovie
{
    private MovieId $id;

    public function __construct(MovieId $id)
    {
        $this->id = $id;
    }

    public function getId(): MovieId
    {
        return $this->id;
    }
}
