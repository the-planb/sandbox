<?php

declare(strict_types=1);

namespace App\Movies\Domain\Model;

use App\Movies\Domain\Model\VO\Title;

final class Movie
{
    private MovieId $id;
    private ?Title $title;

    public function __construct(?Title $title)
    {
        $this->id = new MovieId();
        $this->title = $title;
    }

    public function getId(): MovieId
    {
        return $this->id;
    }

    public function getTitle(): ?Title
    {
        return $this->title;
    }
}
