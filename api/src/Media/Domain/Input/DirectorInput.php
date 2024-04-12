<?php

declare(strict_types=1);

namespace App\Media\Domain\Input;

use App\Media\Domain\Model\DirectorId;
use App\Media\Domain\Model\VO\FullName;
use PlanB\Domain\Input\Input;

final class DirectorInput extends Input
{
    public ?DirectorId $id = null;
    public FullName $name;
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
