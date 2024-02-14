<?php

declare(strict_types=1);

namespace App\Staff\Application\UseCase\Create;

use App\Staff\Domain\Input\UserInput;
use App\Staff\Domain\Model\VO\Email;
use App\Staff\Domain\Model\VO\UserName;

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
