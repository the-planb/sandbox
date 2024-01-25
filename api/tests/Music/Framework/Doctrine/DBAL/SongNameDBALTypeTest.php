<?php

declare(strict_types=1);

namespace App\Tests\Music\Framework\Doctrine\DBAL;

use App\Music\Domain\Model\VO\SongName;
use App\Music\Framework\Doctrine\DBAL\SongNameDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class SongNameDBALTypeTest extends TestCase
{
    public function test_it_has_the_correct_fqn()
    {
        $type = new SongNameDBALType();
        $this->assertEquals(SongName::class, $type->getFQN());
    }

    public function test_it_has_the_correct_name()
    {
        $type = new SongNameDBALType();
        $this->assertEquals('Music.SongName', $type->getName());
    }
}
