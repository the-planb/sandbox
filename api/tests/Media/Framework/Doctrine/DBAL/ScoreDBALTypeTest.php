<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\Score;
use App\Media\Framework\Doctrine\DBAL\ScoreDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ScoreDBALTypeTest extends TestCase
{
    public function test_it_creates_a_new_instance_properly()
    {
        $type = new ScoreDBALType();
        $this->assertInstanceOf(ScoreDBALType::class, $type);
    }

    public function test_it_has_the_proper_name()
    {
        $type = new ScoreDBALType();
        $this->assertEquals('Media.Score', $type->getName());
    }

    public function test_it_has_the_proper_fqn()
    {
        $type = new ScoreDBALType();
        $this->assertEquals(Score::class, $type->getFqn());
    }
}
