<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\FindById;

use App\Media\Domain\Model\GenreId;

class FindGenreById
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
