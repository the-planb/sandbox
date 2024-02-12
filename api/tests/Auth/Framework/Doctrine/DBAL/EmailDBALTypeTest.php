<?php

declare(strict_types=1);

namespace App\Tests\Auth\Framework\Doctrine\DBAL;

use App\Auth\Domain\Model\VO\Email;
use App\Auth\Framework\Doctrine\DBAL\EmailDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class EmailDBALTypeTest extends TestCase
{
    public function test_it_has_the_correct_fqn()
    {
        $type = new EmailDBALType();
        $this->assertEquals(Email::class, $type->getFQN());
    }

    public function test_it_has_the_correct_name()
    {
        $type = new EmailDBALType();
        $this->assertEquals('Auth.Email', $type->getName());
    }
}
