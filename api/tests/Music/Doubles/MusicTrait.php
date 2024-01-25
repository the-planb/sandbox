<?php

namespace App\Tests\Music\Doubles;

use App\Music\Domain\Input\DiscoInput;
use App\Music\Domain\Input\DiscoListInput;
use App\Music\Domain\Input\SongInput;
use App\Music\Domain\Input\SongListInput;
use App\Music\Domain\Model\Disco;
use App\Music\Domain\Model\DiscoList;
use App\Music\Domain\Model\Song;
use App\Music\Domain\Model\SongList;
use App\Music\Domain\Model\VO\DiscoName;
use App\Music\Domain\Model\VO\Duration;
use App\Music\Domain\Model\VO\SongName;
use App\Tests\Music\Doubles\Domain\Input\DiscoInputDouble;
use App\Tests\Music\Doubles\Domain\Input\DiscoListInputDouble;
use App\Tests\Music\Doubles\Domain\Input\SongInputDouble;
use App\Tests\Music\Doubles\Domain\Input\SongListInputDouble;
use App\Tests\Music\Doubles\Domain\Model\DiscoDouble;
use App\Tests\Music\Doubles\Domain\Model\DiscoListDouble;
use App\Tests\Music\Doubles\Domain\Model\SongDouble;
use App\Tests\Music\Doubles\Domain\Model\SongListDouble;
use App\Tests\Music\Doubles\Domain\Model\VO\DiscoNameDouble;
use App\Tests\Music\Doubles\Domain\Model\VO\DurationDouble;
use App\Tests\Music\Doubles\Domain\Model\VO\SongNameDouble;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Framework\Testing\ManagerRegistryDouble;
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
    private function doubleDiscoInput(callable $configure = null): DiscoInput
    {
        $builder = new DiscoInputDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleDiscoListInput(callable $configure = null): DiscoListInput
    {
        $builder = new DiscoListInputDouble($this->prophesize(...), $configure);

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
    private function doubleSongInput(callable $configure = null): SongInput
    {
        $builder = new SongInputDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }

    /**
     * @throws \ReflectionException
     */
    private function doubleSongListInput(callable $configure = null): SongListInput
    {
        $builder = new SongListInputDouble($this->prophesize(...), $configure);

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

    private function doubleManagerRegistry(callable $configure = null): ManagerRegistry
    {
        $builder = new ManagerRegistryDouble($this->prophesize(...), $configure);

        return $builder->reveal();
    }
}
