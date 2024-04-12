<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Update;

use App\Media\Domain\Input\GenreInput;
use App\Media\Domain\Input\MovieListInput;
use App\Media\Domain\Model\GenreId;
use App\Media\Domain\Model\VO\GenreName;

final readonly class UpdateGenre
{
    public GenreId $id;
    public GenreName $name;
    public ?MovieListInput $movies;

    public function __construct(GenreId $id, GenreInput $input)
    {
        $this->id = $id;
        $this->name = $input->name;
        $this->movies = $input->movies ?? MovieListInput::collect();
    }

    public function getId(): GenreId
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'movies' => $this->movies,
        ];
    }
}
