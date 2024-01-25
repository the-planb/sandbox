<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Model;

use App\Music\Domain\Model\Disco;
use App\Music\Domain\Model\DiscoId;
use App\Music\Domain\Model\SongList;
use App\Music\Domain\Model\VO\DiscoName;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class DiscoDouble extends Double
{
    public function reveal(): Disco
    {
        return $this->double->reveal();
    }

    public function withId(DiscoId $id): self
    {
        $this->double()
            ->getId()
            ->willReturn($id)
        ;

        return $this;
    }

    public function withTitle(DiscoName $title): self
    {
        $this->double()
            ->getTitle()
            ->willReturn($title)
        ;

        return $this;
    }

    public function withSongs(SongList $songs): self
    {
        $this->double()
            ->getSongs()
            ->willReturn($songs)
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->withId(new DiscoId());
        $this->withTitle($this->mock(DiscoName::class)->reveal());

        $this->withSongs(SongList::collect());
    }

    protected function classNameOrInterface(): string
    {
        return Disco::class;
    }

    protected function double(): ObjectProphecy|Disco
    {
        return $this->double;
    }
}
