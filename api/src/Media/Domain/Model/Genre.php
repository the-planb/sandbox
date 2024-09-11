<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use App\Media\Domain\Model\VO\GenreName;

class Genre
{
    private GenreId $id;
    private GenreName $name;

    public function __construct(GenreName $name)
    {
        $this->id = new GenreId();
        $this->name = $name;
    }

    public function update(GenreName $name): Genre
    {
        $this->name = $name;

        return $this;
    }

    public function getId(): GenreId
    {
        return $this->id;
    }

    public function getName(): GenreName
    {
        return $this->name;
    }
}
