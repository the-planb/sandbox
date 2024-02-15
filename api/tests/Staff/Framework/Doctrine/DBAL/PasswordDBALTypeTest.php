<?php

declare(strict_types=1);

namespace App\Tests\Staff\Framework\Doctrine\DBAL;

use App\Staff\Domain\Model\VO\Password;
use App\Staff\Framework\Doctrine\DBAL\PasswordDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class PasswordDBALTypeTest extends TestCase
{
    public function test_it_has_the_correct_fqn()
    {
        $type = new PasswordDBALType();
        $this->assertEquals(Password::class, $type->getFQN());
    }

    public function test_it_has_the_correct_name()
    {
        $type = new PasswordDBALType();
        $this->assertEquals('Staff.Password', $type->getName());
    }
}
