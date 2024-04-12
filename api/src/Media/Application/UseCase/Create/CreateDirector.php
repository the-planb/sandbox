<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Create;

use App\Media\Domain\Input\DirectorInput;
use App\Media\Domain\Input\MovieListInput;
use App\Media\Domain\Model\VO\FullName;

final readonly class CreateDirector
{
    public FullName $name;
    public ?MovieListInput $movies;

    public function __construct(DirectorInput $input)
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
