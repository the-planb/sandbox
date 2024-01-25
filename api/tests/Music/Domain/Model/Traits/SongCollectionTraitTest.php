<?php

declare(strict_types=1);

namespace App\Tests\Music\Domain\Model\Traits;

use App\Music\Domain\Input\SongListInput;
use App\Music\Domain\Model\Disco;
use App\Music\Domain\Model\SongId;
use App\Music\Domain\Model\Traits\SongCollectionTrait;
use App\Tests\Music\Doubles\Domain\Model\SongDouble;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class SongCollectionTraitTest extends TestCase
{
    use MusicTrait;

    protected function setUp(): void
    {
        $this->songId = new SongId();
        $sut = (new \ReflectionClass(SongCollectionExample::class))
            ->newInstanceWithoutConstructor()
        ;

        $initial = SongListInput::collect([
            $this->doubleSong(fn (SongDouble $double) => $double->withId($this->songId)),
        ]);

        $sut->execute($initial);
        $this->sut = $sut;
    }

    public function test_it_create_an_collection_properly()
    {
        $this->assertCount(1, $this->sut->getSongs());
        $this->assertSame($this->songId, $this->sut->getSongs()->get(0)->getId());
    }

    public function test_it_is_able_to_add_an_existing_element()
    {
        $input = SongListInput::collect([
            $this->doubleSong(fn (SongDouble $double) => $double->withId($this->songId)),
            $this->doubleSong(),
            $this->doubleSong(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(3, $this->sut->getSongs());
        $this->assertSame($this->songId, $this->sut->getSongs()->get(0)->getId());
    }

    public function test_it_is_able_to_create_a_new_element()
    {
        $input = SongListInput::collect([
            $this->doubleSong(fn (SongDouble $double) => $double->withId($this->songId)),
            $this->doubleSongInput(),
            $this->doubleSongInput(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(3, $this->sut->getSongs());
        $this->assertSame($this->songId, $this->sut->getSongs()->get(0)->getId());
    }

    public function test_it_is_able_to_remove_an_element()
    {
        $input = SongListInput::collect([
            $this->doubleSong(),
            $this->doubleSong(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(2, $this->sut->getSongs());
        $this->assertNotSame($this->songId, $this->sut->getSongs()->get(0)->getId());
    }
}

class SongCollectionExample extends Disco
{
    use SongCollectionTrait;

    public function execute(SongListInput $input)
    {
        $this->songCollection($input);
    }
}
