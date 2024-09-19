<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\Overview;
use App\Media\Framework\Doctrine\DBAL\OverviewDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class OverviewDBALTypeTest extends TestCase
{
    public function test_it_creates_a_new_instance_properly()
    {
        $type = new OverviewDBALType();
        $this->assertInstanceOf(OverviewDBALType::class, $type);
    }

    public function test_it_has_the_proper_name()
    {
        $type = new OverviewDBALType();
        $this->assertEquals('Media.Overview', $type->getName());
    }

    public function test_it_has_the_proper_fqn()
    {
        $type = new OverviewDBALType();
        $this->assertEquals(Overview::class, $type->getFqn());
    }
}
