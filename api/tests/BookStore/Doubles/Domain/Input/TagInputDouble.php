<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Input;

use App\BookStore\Domain\Input\TagInput;
use App\BookStore\Domain\Model\TagId;
use App\BookStore\Domain\Model\VO\TagName;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class TagInputDouble extends Double
{
    private TagInput $input;

    public function __construct(callable $prophesize, callable $configurator = null)
    {
        $this->input = new TagInput();
        parent::__construct($prophesize, $configurator);
    }

    public function reveal(): TagInput
    {
        return $this->input;
    }

    public function withId(TagId $id): self
    {
        $this->double()
            ->id = $id
        ;

        return $this;
    }

    public function withName(TagName $name): self
    {
        $this->double()
            ->name = $name
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->double()->name = $this->mock(TagName::class)->reveal();
    }

    protected function classNameOrInterface(): string
    {
        return TagInput::class;
    }

    protected function double(): ObjectProphecy|TagInput
    {
        return $this->input;
    }
}
