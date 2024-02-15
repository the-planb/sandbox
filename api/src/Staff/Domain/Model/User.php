<?php

declare(strict_types=1);

namespace App\Staff\Domain\Model;

use App\Staff\Domain\Model\VO\Email;
use App\Staff\Domain\Model\VO\Password;
use App\Staff\Domain\Model\VO\UserName;
use PlanB\Domain\Model\Entity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements Entity, UserInterface, PasswordAuthenticatedUserInterface
{
    private UserId $id;
    private UserName $name;
    private Email $email;
    private RoleList $roles;
    private Password $password;

    public function __construct(UserName $name, Email $email, RoleList $roles, Password $password)
    {
        $this->id = new UserId();
        $this->name = $name;
        $this->email = $email;
        $this->roles = $roles;
        $this->password = $password;
    }

    public function update(UserName $name, Email $email, RoleList $roles, Password $password): self
    {
        $this->name = $name;
        $this->email = $email;
        $this->roles = $roles;
        $this->password = $password;

        return $this;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): UserName
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return $this->roles->toArray();
    }

    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
}
