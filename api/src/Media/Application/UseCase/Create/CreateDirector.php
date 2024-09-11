<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Create;

use App\Media\Domain\Model\VO\FullName;

class CreateDirector
{
    public FullName $name;

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
