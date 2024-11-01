<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\FindById;

use App\Auth\Domain\Model\UserId;

final class FindUserById
{
	private UserId $userId;

	public function __construct(UserId $userId)
	{
		$this->userId = $userId;
	}

	public function getId(): UserId
	{
		return $this->userId;
	}
}
