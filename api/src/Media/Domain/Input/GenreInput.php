<?php

declare(strict_types=1);

namespace App\Media\Domain\Input;

use App\Media\Domain\Model\GenreId;
use App\Media\Domain\Model\VO\GenreName;
use PlanB\Domain\Input\Input;

final class GenreInput extends Input
{
    public ?GenreId $id = null;
    public GenreName $name;
    public ?MovieListInput $movies;

    /**
     * @throws \Exception
     */
    public static function make(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'movies' => $this->movies ?? MovieListInput::collect(),
        ];
    }
}
