<?php

declare(strict_types=1);

namespace App\Tests\Music\Domain\Model;

use App\Music\Domain\Model\Song;
use App\Music\Domain\Model\SongId;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class SongTest extends TestCase
{
    use MusicTrait;

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_instantiated_properly()
    {
        $title = $this->doubleSongName();
        $duration = $this->doubleDuration();
        $album = $this->doubleDisco();

        $song = new Song(...[
            'title' => $title,
            'duration' => $duration,
            'album' => $album,
        ]);

        $this->assertInstanceOf(SongId::class, $song->getId());
        $this->assertSame($song->getTitle(), $title);
        $this->assertSame($song->getDuration(), $duration);
        $this->assertSame($song->getAlbum(), $album);
    }

    /**
     * @throws \ReflectionException
     */
    public function test_it_can_be_updated_properly()
    {
        $song = (new \ReflectionClass(Song::class))
            ->newInstanceWithoutConstructor()
        ;

        $title = $this->doubleSongName();
        $duration = $this->doubleDuration();

        $song->update(...[
            'title' => $title,
            'duration' => $duration,
        ]);

        $this->assertSame($song->getTitle(), $title);
        $this->assertSame($song->getDuration(), $duration);
    }
}
