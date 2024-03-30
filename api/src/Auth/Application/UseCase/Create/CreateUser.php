<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\Create;

use App\Auth\Domain\Input\UserInput;
use App\Auth\Domain\Model\RoleList;
use App\Auth\Domain\Model\VO\Email;
use App\Auth\Domain\Model\VO\Password;
use App\Auth\Domain\Model\VO\UserName;

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
