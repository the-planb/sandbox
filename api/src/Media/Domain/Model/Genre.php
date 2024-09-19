<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use App\Media\Domain\Model\VO\GenreName;
use PlanB\Domain\Model\Entity;

class Genre implements Entity
{
    private GenreId $id;
    private GenreName $name;

    public function __construct(GenreName $name)
    {
        $this->id = new GenreId();

        $this->init($name);
        // lanzar evento
    }

    public function update(GenreName $name): static
    {
        $this->init($name);
        // lanzar evento
        return $this;
    }

    private function init(GenreName $name): void
    {
        $this->name = $name;
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
