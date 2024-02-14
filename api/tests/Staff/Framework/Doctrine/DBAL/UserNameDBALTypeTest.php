<?php

declare(strict_types=1);

namespace App\Tests\Staff\Framework\Doctrine\DBAL;

use App\Staff\Domain\Model\VO\UserName;
use App\Staff\Framework\Doctrine\DBAL\UserNameDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class UserNameDBALTypeTest extends TestCase
{
    public function test_it_has_the_correct_fqn()
    {
        $type = new UserNameDBALType();
        $this->assertEquals(UserName::class, $type->getFQN());
    }

    public function test_it_has_the_correct_name()
    {
        $type = new UserNameDBALType();
        $this->assertEquals('Staff.UserName', $type->getName());
    }
}
