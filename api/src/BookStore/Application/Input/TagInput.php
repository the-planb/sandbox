<?php

declare(strict_types=1);

namespace App\BookStore\Application\Input;

use App\BookStore\Domain\Model\TagId;
use App\BookStore\Domain\Model\VO\TagName;

final class TagInput
{
    public TagId $id;
    public TagName $name;
}
