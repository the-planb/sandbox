<?php

declare(strict_types=1);

namespace App\Tests\Music\Domain\Model\VO;

use App\Music\Domain\Model\VO\SongName;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\FakesTrait;

/**
 * @internal
 */
class SongNameTest extends TestCase
{
    use MusicTrait;
    use FakesTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $name = $this->string();

        $sut = new SongName(...[
            'name' => $name,
        ]);

        $this->assertSame($sut->getName(), $name);

        $this->assertSame((string) $sut, $name);
    }
}
