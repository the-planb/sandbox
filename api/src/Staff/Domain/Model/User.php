<?php

declare(strict_types=1);

namespace App\Staff\Domain\Model;

use App\Staff\Domain\Model\VO\Email;
use App\Staff\Domain\Model\VO\UserName;
use PlanB\Domain\Model\Entity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements Entity, UserInterface, PasswordAuthenticatedUserInterface
{
    private UserId $id;
    private UserName $name;
    private Email $email;

    public function __construct(UserName $name, Email $email)
    {
        $this->id = new UserId();
        $this->name = $name;
        $this->email = $email;
    }

    public function update(UserName $name, Email $email): self
    {
        $this->name = $name;
        $this->email = $email;

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

    public function getPassword(): ?string
    {
        return 'xxxx';
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
}
