<?php

declare(strict_types=1);

namespace App\Tests\Staff\Framework\Doctrine\DBAL;

use App\Staff\Domain\Model\VO\Email;
use App\Staff\Framework\Doctrine\DBAL\EmailDBALType;
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
        $this->assertEquals('Staff.Email', $type->getName());
    }
}
