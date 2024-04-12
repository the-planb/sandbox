<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Update;

use App\Media\Domain\Input\DirectorInput;
use App\Media\Domain\Input\MovieListInput;
use App\Media\Domain\Model\DirectorId;
use App\Media\Domain\Model\VO\FullName;

final readonly class UpdateDirector
{
    public DirectorId $id;
    public FullName $name;
    public ?MovieListInput $movies;

    public function __construct(DirectorId $id, DirectorInput $input)
    {
        $this->id = $id;
        $this->name = $input->name;
        $this->movies = $input->movies ?? MovieListInput::collect();
    }

    public function getId(): DirectorId
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
