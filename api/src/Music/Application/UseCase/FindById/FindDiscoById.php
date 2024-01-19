<?php

declare(strict_types=1);

namespace App\Music\Application\UseCase\FindById;

use App\Music\Domain\Model\DiscoId;

final class FindDiscoById
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
