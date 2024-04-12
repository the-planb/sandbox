<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Create;

use App\Media\Domain\Input\GenreInput;
use App\Media\Domain\Input\MovieListInput;
use App\Media\Domain\Model\VO\GenreName;

final readonly class CreateGenre
{
    public GenreName $name;
    public ?MovieListInput $movies;

    public function __construct(GenreInput $input)
    {
        $this->name = $input->name;
        $this->movies = $input->movies ?? MovieListInput::collect();
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'movies' => $this->movies,
        ];
    }
}
