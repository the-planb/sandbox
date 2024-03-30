<?php

declare(strict_types=1);

namespace App\Movies\Application\UseCase\Update;

use App\Movies\Domain\Input\MovieInput;
use App\Movies\Domain\Model\MovieId;
use App\Movies\Domain\Model\VO\Title;

final class UpdateMovie
{
    private MovieId $id;
    private ?Title $title;

    public function __construct(MovieId $id, MovieInput $input)
    {
        $this->id = $id;
        $this->title = $input->title;
    }

    public function getId(): MovieId
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
        ];
    }
}
