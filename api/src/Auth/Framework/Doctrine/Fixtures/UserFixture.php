<?php

declare(strict_types=1);

namespace App\Auth\Framework\Doctrine\Fixtures;

use App\Auth\Application\UseCase\Create\CreateUser;
use App\Auth\Domain\Input\UserInput;
use App\Auth\Domain\Model\RoleList;
use App\Auth\Domain\Model\VO\Email;
use App\Auth\Domain\Model\VO\Password;
use App\Auth\Domain\Model\VO\UserName;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

/**
 * @codeCoverageIgnore
 */
final class UserFixture extends UseCaseFixture // implements DependentFixtureInterface
{
    public function loadData(): void
    {
        $this->createRange(['admin', 'editor', 'tester'], function (string $name) {
            $input = new UserInput();
            $input->name = new UserName($name);
            $input->email = new Email("{$name}@prueba.local");
            $input->roles = RoleList::collect([strtoupper("ROLE_{$name}")]);
            $input->password = new Password($name);

            $command = new CreateUser($input);

            return $this->handle($command);
        });
    }

    //    public function getDependencies()
    //    {
    //        return [OtherFixture];
    //    }

    public function allowedEnvironments(): array
    {
        return ['dev'];
    }
}
