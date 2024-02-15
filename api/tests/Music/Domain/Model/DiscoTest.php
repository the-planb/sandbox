<?php

declare(strict_types=1);

namespace App\Tests\Music\Domain\Model;

use App\Music\Domain\Model\Disco;
use App\Music\Domain\Model\DiscoId;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class DiscoTest extends TestCase
{
    use MusicTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $title = $this->doubleDiscoName();
        $songs = $this->doubleSongListInput();

        $disco = new Disco(...[
            'title' => $title,
            'songs' => $songs,
        ]);

        $this->assertInstanceOf(DiscoId::class, $disco->getId());
        $this->assertSame($disco->getTitle(), $title);
        $this->assertSame($disco->getSongs()->toArray(), $songs->toArray());
    }

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_updated_properly()
    {
        $disco = (new \ReflectionClass(Disco::class))
            ->newInstanceWithoutConstructor()
        ;

        $title = $this->doubleDiscoName();
        $songs = $this->doubleSongListInput();

        $disco->update(...[
            'title' => $title,
            'songs' => $songs,
        ]);

        $this->assertSame($disco->getTitle(), $title);
        $this->assertSame($disco->getSongs()->toArray(), $songs->toArray());
    }
}
