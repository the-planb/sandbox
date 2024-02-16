<?php

declare(strict_types=1);

namespace App\Tests\Staff\Framework\Symfony\Component\PasswordHasher\Hasher;

use App\Staff\Domain\Service\Exception\PlainPasswordMissingException;
use App\Staff\Framework\Symfony\Component\PasswordHasher\Hasher\UserPasswordEncoder;
use App\Tests\Staff\Doubles\Domain\Model\VO\PasswordDouble;
use App\Tests\Staff\Doubles\StaffTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @internal
 */
class UserPasswordEncoderTest extends TestCase
{
    use StaffTrait;

    public function test_it_can_encode_a_password_properly()
    {
        $user = $this->doubleUser();
        $password = $this->doublePassword(function (PasswordDouble $double) {
            $double->withPassword('secret');
        });

        $hasher = $this->prophesize(UserPasswordHasherInterface::class);
        $hasher->hashPassword($user, 'secret')
            ->willReturn('encoded_secret')
        ;

        $encoder = new UserPasswordEncoder($hasher->reveal());
        $encoder->setPassword($password);

        $this->assertEquals('encoded_secret', $encoder->hash($user));
    }

    public function test_it_throws_an_exceptio_when_original_password_is_not_set()
    {
        $user = $this->doubleUser();

        $hasher = $this->prophesize(UserPasswordHasherInterface::class);

        $encoder = new UserPasswordEncoder($hasher->reveal());

        $this->expectException(PlainPasswordMissingException::class);
        $encoder->hash($user);
    }
}
