<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Update;

use App\Media\Domain\Model\GenreId;
use App\Media\Domain\Model\VO\GenreName;

class UpdateGenre
{
    public GenreId $id;
    public GenreName $name;

    public function getId(): GenreId
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
