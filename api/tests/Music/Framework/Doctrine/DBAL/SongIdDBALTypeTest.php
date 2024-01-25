<?php

declare(strict_types=1);

namespace App\Tests\Music\Framework\Doctrine\DBAL;

use App\Music\Domain\Model\SongId;
use App\Music\Framework\Doctrine\DBAL\SongIdDBALType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 */
class SongIdDBALTypeTest extends TestCase
{
    use ProphecyTrait;

    public function test_it_converts_value_to_php_object_properly()
    {
        $platform = $this->prophesize(AbstractPlatform::class)
            ->reveal()
        ;

        $type = new SongIdDBALType();
        $songId = $type->convertToPHPValue('018d92a8-3d51-60c7-93ba-4f655632e124', $platform);

        $this->assertInstanceOf(SongId::class, $songId);
        $this->assertEquals('018d92a8-3d51-60c7-93ba-4f655632e124', (string) $songId);
    }

    public function test_it_has_the_correct_name()
    {
        $type = new SongIdDBALType();
        $this->assertEquals('Music.SongId', $type->getName());
    }
}
