<?php

declare(strict_types=1);

namespace App\Staff\Application\UseCase\Update;

use App\Staff\Domain\Input\UserInput;
use App\Staff\Domain\Model\UserId;
use App\Staff\Domain\Model\VO\Email;
use App\Staff\Domain\Model\VO\UserName;

final class UpdateUser
{
    private UserName $name;
    private Email $email;

    private UserId $id;

    public function __construct(UserInput $input, UserId $userId)
    {
        $this->name = $input->name;
        $this->email = $input->email;

        $this->id = $userId;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    public function getId(): UserId
    {
        return $this->id;
    }
}
