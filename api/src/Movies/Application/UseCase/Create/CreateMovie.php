<?php

declare(strict_types=1);

namespace App\Movies\Application\UseCase\Create;

use App\Movies\Domain\Input\MovieInput;
use App\Movies\Domain\Model\VO\Title;

final class CreateMovie
{
    private ?Title $title;

    public function __construct(MovieInput $input)
    {
        $this->title = $input->title;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
        ];
    }
}
