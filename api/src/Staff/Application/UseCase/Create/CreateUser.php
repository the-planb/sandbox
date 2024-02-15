<?php

declare(strict_types=1);

namespace App\Staff\Application\UseCase\Create;

use App\Staff\Domain\Input\UserInput;
use App\Staff\Domain\Model\RoleList;
use App\Staff\Domain\Model\VO\Email;
use App\Staff\Domain\Model\VO\Password;
use App\Staff\Domain\Model\VO\UserName;

final class CreateUser
{
    private UserName $name;
    private Email $email;
    private RoleList $roles;
    private Password $password;

    public function __construct(UserInput $input)
    {
        $this->name = $input->name;
        $this->email = $input->email;
        $this->roles = $input->roles;
        $this->password = $input->password;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles,
            'password' => $this->password,
        ];
    }
}
