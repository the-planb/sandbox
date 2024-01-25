<?php

declare(strict_types=1);

namespace App\Tests\Music\Framework\Doctrine\DBAL;

use App\Music\Domain\Model\VO\Duration;
use App\Music\Framework\Doctrine\DBAL\DurationDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class DurationDBALTypeTest extends TestCase
{
    public function test_it_has_the_correct_fqn()
    {
        $type = new DurationDBALType();
        $this->assertEquals(Duration::class, $type->getFQN());
    }

    public function test_it_has_the_correct_name()
    {
        $type = new DurationDBALType();
        $this->assertEquals('Music.Duration', $type->getName());
    }
}
