<?php

declare(strict_types=1);

namespace App\Music\Application\UseCase\Delete;

use App\Music\Domain\Model\DiscoId;

final class DeleteDisco
{
    private DiscoId $discoId;

    public function __construct(DiscoId $discoId)
    {
        $this->discoId = $discoId;
    }

    public function getId(): DiscoId
    {
        return $this->discoId;
    }
}
