<?php

declare(strict_types=1);

namespace App\Borrame\Application\Input;

use App\Borrame\Domain\Model\RoleList;
use App\Borrame\Domain\Model\UserId;
use App\Borrame\Domain\Model\VO\Email;
use App\Borrame\Domain\Model\VO\Username;

final class UserInput
{
    public ?UserId $id = null;
    public Username $username;
    public Email $email;
    public RoleList $roles;
    public string $password;
}
