<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Update;

use App\Media\Domain\Model\DirectorId;
use App\Media\Domain\Model\VO\FullName;

class UpdateDirector
{
    public DirectorId $id;
    public FullName $name;

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    public function getId(): DirectorId
    {
        return $this->id;
    }
}
