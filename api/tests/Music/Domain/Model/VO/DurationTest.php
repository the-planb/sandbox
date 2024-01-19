<?php

declare(strict_types=1);

namespace App\Tests\Music\Domain\Model\VO;

use App\Music\Domain\Model\VO\Duration;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\FakesTrait;

/**
 * @internal
 */
class DurationTest extends TestCase
{
    use MusicTrait;
    use FakesTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $duration = $this->int();

        $sut = new Duration(...[
            'duration' => $duration,
        ]);

        $this->assertSame($sut->getDuration(), $duration);

        $this->assertSame($sut->toInt(), $duration);
    }
}
