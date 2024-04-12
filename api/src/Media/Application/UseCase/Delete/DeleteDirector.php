<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Delete;

use App\Media\Domain\Model\DirectorId;

final class DeleteDirector
{
    public DirectorId $id;

    public function __construct(DirectorId $id)
    {
        $this->id = $id;
    }

    public function getId(): DirectorId
    {
        return $this->id;
    }
}
