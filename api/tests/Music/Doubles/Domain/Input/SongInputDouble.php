<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Input;

use App\Music\Domain\Input\SongInput;
use App\Music\Domain\Model\SongId;
use App\Music\Domain\Model\VO\Duration;
use App\Music\Domain\Model\VO\SongName;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class SongInputDouble extends Double
{
    private SongInput $input;

    public function __construct(callable $prophesize, callable $configurator = null)
    {
        $this->input = new SongInput();
        parent::__construct($prophesize, $configurator);
    }

    public function reveal(): SongInput
    {
        return $this->input;
    }

    public function withId(SongId $id): self
    {
        $this->double()
            ->id = $id
        ;

        return $this;
    }

    public function withTitle(SongName $title): self
    {
        $this->double()
            ->title = $title
        ;

        return $this;
    }

    public function withDuration(?Duration $duration): self
    {
        $this->double()
            ->duration = $duration
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->double()->title = $this->mock(SongName::class)->reveal();

        $this->double()->duration = $this->mock(Duration::class)->reveal();
    }

    protected function classNameOrInterface(): string
    {
        return SongInput::class;
    }

    protected function double(): ObjectProphecy|SongInput
    {
        return $this->input;
    }
}
