<?php

declare(strict_types=1);

namespace App\Staff\Application\UseCase\Update;

use App\Staff\Domain\Input\UserInput;
use App\Staff\Domain\Model\RoleList;
use App\Staff\Domain\Model\UserId;
use App\Staff\Domain\Model\VO\Email;
use App\Staff\Domain\Model\VO\Password;
use App\Staff\Domain\Model\VO\UserName;

final class UpdateUser
{
    private UserName $name;
    private Email $email;
    private RoleList $roles;
    private Password $password;

    private UserId $id;

    public function __construct(UserInput $input, UserId $userId)
    {
        $this->name = $input->name;
        $this->email = $input->email;
        $this->roles = $input->roles;
        $this->password = $input->password;

        $this->id = $userId;
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

    public function getId(): UserId
    {
        return $this->id;
    }
}
