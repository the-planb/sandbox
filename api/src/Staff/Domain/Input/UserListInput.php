<?php

declare(strict_types=1);

namespace App\Staff\Domain\Input;

use App\Staff\Domain\Model\User;
use PlanB\Domain\Input\InputList;
use PlanB\DS\Attribute\ElementType;

#[ElementType(UserInput::class, User::class)]
final class UserListInput extends InputList
{
}
