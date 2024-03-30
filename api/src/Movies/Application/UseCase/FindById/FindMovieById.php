<?php

declare(strict_types=1);

namespace App\Movies\Application\UseCase\FindById;

use App\Movies\Domain\Model\MovieId;

final class FindMovieById
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
