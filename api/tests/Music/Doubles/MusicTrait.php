<?php

namespace App\Tests\Music\Doubles;

use App\Music\Domain\Model\Disco;
use App\Music\Domain\Model\DiscoList;
use App\Music\Domain\Model\Song;
use App\Music\Domain\Model\SongList;
use App\Music\Domain\Model\VO\DiscoName;
use App\Music\Domain\Model\VO\Duration;
use App\Music\Domain\Model\VO\SongName;
use App\Tests\Music\Doubles\Domain\Model\DiscoDouble;
use App\Tests\Music\Doubles\Domain\Model\DiscoListDouble;
use App\Tests\Music\Doubles\Domain\Model\SongDouble;
use App\Tests\Music\Doubles\Domain\Model\SongListDouble;
use App\Tests\Music\Doubles\Domain\Model\VO\DiscoNameDouble;
use App\Tests\Music\Doubles\Domain\Model\VO\DurationDouble;
use App\Tests\Music\Doubles\Domain\Model\VO\SongNameDouble;
use Prophecy\PhpUnit\ProphecyTrait;

trait MusicTrait
{
    use ProphecyTrait;

    /**
     * @throws \ReflectionException
     */
    private function doubleSongName(callable $configure = null): SongName
    {
        $builder = new SongNameDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleDisco(callable $configure = null): Disco
    {
        $builder = new DiscoDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleDiscoList(callable $configure = null): DiscoList
    {
        $builder = new DiscoListDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleDuration(callable $configure = null): Duration
    {
        $builder = new DurationDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleDiscoName(callable $configure = null): DiscoName
    {
        $builder = new DiscoNameDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleSong(callable $configure = null): Song
    {
        $builder = new SongDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleSongList(callable $configure = null): SongList
    {
        $builder = new SongListDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }
}
