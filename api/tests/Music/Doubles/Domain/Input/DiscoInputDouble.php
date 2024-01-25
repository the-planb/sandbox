<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Input;

use App\Music\Domain\Input\DiscoInput;
use App\Music\Domain\Input\SongListInput;
use App\Music\Domain\Model\DiscoId;
use App\Music\Domain\Model\VO\DiscoName;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class DiscoInputDouble extends Double
{
    private DiscoInput $input;

    public function __construct(callable $prophesize, callable $configurator = null)
    {
        $this->input = new DiscoInput();
        parent::__construct($prophesize, $configurator);
    }

    public function reveal(): DiscoInput
    {
        return $this->input;
    }

    public function withId(DiscoId $id): self
    {
        $this->double()
            ->id = $id
        ;

        return $this;
    }

    public function withTitle(DiscoName $title): self
    {
        $this->double()
            ->title = $title
        ;

        return $this;
    }

    public function withSongs(SongListInput $songs): self
    {
        $this->double()
            ->songs = $songs
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->double()->title = $this->mock(DiscoName::class)->reveal();

        $this->double()->songs = SongListInput::collect();
    }

    protected function classNameOrInterface(): string
    {
        return DiscoInput::class;
    }

    protected function double(): ObjectProphecy|DiscoInput
    {
        return $this->input;
    }
}
