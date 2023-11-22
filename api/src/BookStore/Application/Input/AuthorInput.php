<?php

declare(strict_types=1);

namespace App\BookStore\Application\Input;

use App\BookStore\Domain\Model\AuthorId;
use App\BookStore\Domain\Model\VO\FullName;

final class AuthorInput
{
    public AuthorId $id;
    public FullName $name;
}
