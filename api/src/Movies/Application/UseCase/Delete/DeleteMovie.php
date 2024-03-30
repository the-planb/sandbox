<?php

declare(strict_types=1);

namespace App\Movies\Application\UseCase\Delete;

use App\Movies\Domain\Model\MovieId;

final class DeleteMovie
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
