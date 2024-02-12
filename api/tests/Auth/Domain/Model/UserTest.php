<?php

declare(strict_types=1);

namespace App\Tests\Auth\Domain\Model;

use App\Auth\Domain\Model\User;
use App\Auth\Domain\Model\UserId;
use App\Tests\Auth\Doubles\AuthTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class UserTest extends TestCase
{
    use AuthTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $name = $this->doubleUserName();
        $email = $this->doubleEmail();

        $user = new User(...[
            'name' => $name,
            'email' => $email,
        ]);

        $this->assertInstanceOf(UserId::class, $user->getId());
        $this->assertSame($user->getName(), $name);
        $this->assertSame($user->getEmail(), $email);
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
        $user->update(...[
            'name' => $name,
            'email' => $email,
        ]);

        $this->assertSame($user->getName(), $name);
        $this->assertSame($user->getEmail(), $email);
    }
}
