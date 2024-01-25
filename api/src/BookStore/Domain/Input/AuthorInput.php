<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Input;

use App\BookStore\Domain\Model\AuthorId;
use App\BookStore\Domain\Model\VO\FullName;
use PlanB\Domain\Input\Input;

final class AuthorInput extends Input
{
    public ?AuthorId $id = null;

    public FullName $name;
}
