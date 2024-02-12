<?php

declare(strict_types=1);

namespace App\Borrame\Framework\Doctrine\Fixtures;

use App\Borrame\Application\CreateUser;
use App\Borrame\Application\Input\UserInput;
use App\Borrame\Domain\Model\RoleList;
use App\Borrame\Domain\Model\VO\Email;
use App\Borrame\Domain\Model\VO\Username;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

final class UserFixture extends UseCaseFixture
{
    public function loadData(): void
    {
        $this->createRange(['editor', 'admin'], function (string $name) {
            $input = new UserInput();
            $input->username = new Username($name);
            $input->email = new Email("{$name}@prueba.local");

            $input->roles = RoleList::collect([
                strtoupper("ROLE_{$name}"),
            ]);

            $input->password = $name;

            $command = new CreateUser($input);

            return $this->handle($command);
        });
    }

    public function allowedEnvironments(): array
    {
        return ['dev'];
    }
}
