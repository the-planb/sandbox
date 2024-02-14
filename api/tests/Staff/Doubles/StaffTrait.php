<?php

namespace App\Tests\Staff\Doubles;

use App\Staff\Domain\Input\UserInput;
use App\Staff\Domain\Input\UserListInput;
use App\Staff\Domain\Model\User;
use App\Staff\Domain\Model\UserList;
use App\Staff\Domain\Model\VO\Email;
use App\Staff\Domain\Model\VO\UserName;
use App\Tests\Staff\Doubles\Domain\Input\UserInputDouble;
use App\Tests\Staff\Doubles\Domain\Input\UserListInputDouble;
use App\Tests\Staff\Doubles\Domain\Model\UserDouble;
use App\Tests\Staff\Doubles\Domain\Model\UserListDouble;
use App\Tests\Staff\Doubles\Domain\Model\VO\EmailDouble;
use App\Tests\Staff\Doubles\Domain\Model\VO\UserNameDouble;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Framework\Testing\ManagerRegistryDouble;
use Prophecy\PhpUnit\ProphecyTrait;

trait StaffTrait
{
    use ProphecyTrait;

    /**
     * @throws \ReflectionException
     */
    private function doubleUserName(callable $configure = null): UserName
    {
        $builder = new UserNameDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleUser(callable $configure = null): User
    {
        $builder = new UserDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleUserInput(callable $configure = null): UserInput
    {
        $builder = new UserInputDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleUserListInput(callable $configure = null): UserListInput
    {
        $builder = new UserListInputDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleUserList(callable $configure = null): UserList
    {
        $builder = new UserListDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleEmail(callable $configure = null): Email
    {
        $builder = new EmailDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    private function doubleManagerRegistry(callable $configure = null): ManagerRegistry
    {
        $builder = new ManagerRegistryDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }
}
