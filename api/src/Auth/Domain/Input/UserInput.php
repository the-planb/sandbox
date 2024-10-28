<?php

declare(strict_types=1);

namespace App\Auth\Domain\Input;

use App\Auth\Domain\Model\RoleList;
use App\Auth\Domain\Model\VO\Email;
use App\Auth\Domain\Model\VO\Password;
use App\Auth\Domain\Model\VO\UserName;
use PlanB\Domain\Input\Input;

final class UserInput extends Input
{
	//    public ?UserId $id = null;

	public UserName $name;
	public Email $email;
	public RoleList $roles;
	public Password $password;

	/**
	 * @throws \Exception
	 */
	public static function make(array $data): self
	{
		return new self($data);
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
