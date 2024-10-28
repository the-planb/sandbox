<?php

declare(strict_types=1);

namespace App\Auth\Domain\Model;

use App\Auth\Domain\Model\VO\Email;
use App\Auth\Domain\Model\VO\Password;
use App\Auth\Domain\Model\VO\UserName;
use App\Auth\Domain\Service\PasswordEncoder;
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

	public function __construct(UserName $name, Email $email, RoleList $roles, PasswordEncoder $encoder)
	{
		$this->id = new UserId();
		$this->name = $name;
		$this->email = $email;
		$this->roles = $roles;
		$this->password = $encoder->hash($this);
	}

	public function update(UserName $name, Email $email, RoleList $roles): self
	{
		$this->name = $name;
		$this->email = $email;
		$this->roles = $roles;

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

	public function eraseCredentials(): void
	{
	}

	public function getUserIdentifier(): string
	{
		return (string) $this->name;
	}
}
