<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\Create;

use App\Auth\Domain\Input\UserInput;
use App\Auth\Domain\Model\VO\Email;
use App\Auth\Domain\Model\VO\UserName;

final class CreateUser
{
    private UserName $name;
    private Email $email;

    public function __construct(UserInput $input)
    {
        $this->name = $input->name;
        $this->email = $input->email;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
