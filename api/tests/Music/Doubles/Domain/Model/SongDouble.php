<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Model;

use App\Music\Domain\Model\Song;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class SongDouble extends Double
{
    public function reveal(): Song
    {
        return $this->double->reveal();
    }

    public function withId(SongId $id): self
    {
        $this->double()
            ->getId()
            ->willReturn($id)
        ;

        return $this;
    }

    public function withTitle(SongName $title): self
    {
        $this->double()
            ->getTitle()
            ->willReturn($title)
        ;

        return $this;
    }

    public function withDuration(?Duration $duration): self
    {
        $this->double()
            ->getDuration()
            ->willReturn($duration)
        ;

        return $this;
    }

    public function withAlbum(Disco $album): self
    {
        $this->double()
            ->getAlbum()
            ->willReturn($album)
        ;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return Song::class;
    }

    protected function double(): ObjectProphecy|Song
    {
        return $this->double;
    }
}
