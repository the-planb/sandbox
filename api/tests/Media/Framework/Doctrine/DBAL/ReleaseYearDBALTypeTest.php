<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\ReleaseYear;
use App\Media\Framework\Doctrine\DBAL\ReleaseYearDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ReleaseYearDBALTypeTest extends TestCase
{
    public function test_it_creates_a_new_instance_properly()
    {
        $type = new ReleaseYearDBALType();
        $this->assertInstanceOf(ReleaseYearDBALType::class, $type);
    }

    public function test_it_has_the_proper_name()
    {
        $type = new ReleaseYearDBALType();
        $this->assertEquals('Media.ReleaseYear', $type->getName());
    }

    public function test_it_has_the_proper_fqn()
    {
        $type = new ReleaseYearDBALType();
        $this->assertEquals(ReleaseYear::class, $type->getFqn());
    }
}
