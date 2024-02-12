<?php

declare(strict_types=1);

namespace App\Auth\Domain\Input;

use App\Auth\Domain\Model\UserId;
use App\Auth\Domain\Model\VO\Email;
use App\Auth\Domain\Model\VO\UserName;
use PlanB\Domain\Input\Input;

final class UserInput extends Input
{
    public ?UserId $id = null;

    public UserName $name;
    public Email $email;
}
