<?php

declare(strict_types=1);

namespace App\Movies\Domain\Input;

use App\Movies\Domain\Model\VO\Title;
use PlanB\Domain\Input\Input;

final class MovieInput extends Input
{
    public ?Title $title;
}
