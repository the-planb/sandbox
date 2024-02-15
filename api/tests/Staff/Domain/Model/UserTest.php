<?php

declare(strict_types=1);

namespace App\Tests\Staff\Domain\Model;

use App\Staff\Domain\Model\User;
use App\Staff\Domain\Model\UserId;
use App\Tests\Staff\Doubles\StaffTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class UserTest extends TestCase
{
    use StaffTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $name = $this->doubleUserName();
        $email = $this->doubleEmail();
        $roles = $this->doubleRoleList();
        $password = $this->doublePassword();

        $user = new User(...[
            'name' => $name,
            'email' => $email,
            'roles' => $roles,
            'password' => $password,
        ]);

        $user->eraseCredentials();

        $this->assertInstanceOf(UserId::class, $user->getId());
        $this->assertSame($user->getName(), $name);
        $this->assertSame($user->getEmail(), $email);
        $this->assertSame($user->getRoles(), $roles->toArray());
        $this->assertSame($user->getPassword(), (string) $password);
        $this->assertSame($user->getUserIdentifier(), (string) $email);
    }

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_updated_properly()
    {
        $user = (new \ReflectionClass(User::class))
            ->newInstanceWithoutConstructor()
        ;

        $name = $this->doubleUserName();
        $email = $this->doubleEmail();
        $roles = $this->doubleRoleList();
        $password = $this->doublePassword();

        $user->update(...[
            'name' => $name,
            'email' => $email,
            'roles' => $roles,
            'password' => $password,
        ]);

        $user->eraseCredentials();

        $this->assertSame($user->getName(), $name);
        $this->assertSame($user->getEmail(), $email);
        $this->assertSame($user->getRoles(), $roles->toArray());
        $this->assertSame($user->getPassword(), (string) $password);
        $this->assertSame($user->getUserIdentifier(), (string) $email);
    }
}
