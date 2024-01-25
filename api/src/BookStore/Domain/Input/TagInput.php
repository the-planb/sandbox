<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Input;

use App\BookStore\Domain\Model\TagId;
use App\BookStore\Domain\Model\VO\TagName;
use PlanB\Domain\Input\Input;

final class TagInput extends Input
{
    public ?TagId $id = null;

    public TagName $name;
}
