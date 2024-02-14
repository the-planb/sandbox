<?php

declare(strict_types=1);

namespace App\Staff\Domain\Input;

use App\Staff\Domain\Model\UserId;
use App\Staff\Domain\Model\VO\Email;
use App\Staff\Domain\Model\VO\UserName;
use PlanB\Domain\Input\Input;

final class UserInput extends Input
{
    public ?UserId $id = null;

    public UserName $name;
    public Email $email;
}
