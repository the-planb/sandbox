<?php

declare(strict_types=1);

namespace App\Tests\Music\Framework\Doctrine\DBAL;

use App\Music\Domain\Model\VO\DiscoName;
use App\Music\Framework\Doctrine\DBAL\DiscoNameDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class DiscoNameDBALTypeTest extends TestCase
{
    public function test_it_has_the_correct_fqn()
    {
        $type = new DiscoNameDBALType();
        $this->assertEquals(DiscoName::class, $type->getFQN());
    }

    public function test_it_has_the_correct_name()
    {
        $type = new DiscoNameDBALType();
        $this->assertEquals('Music.DiscoName', $type->getName());
    }
}
