<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Input;

use App\BookStore\Domain\Input\BookInput;
use App\BookStore\Domain\Input\TagListInput;
use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\Title;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class BookInputDouble extends Double
{
    private BookInput $input;

    public function __construct(callable $prophesize, callable $configurator = null)
    {
        $this->input = new BookInput();
        parent::__construct($prophesize, $configurator);
    }

    public function reveal(): BookInput
    {
        return $this->input;
    }

    public function withId(BookId $id): self
    {
        $this->double()
            ->id = $id
        ;

        return $this;
    }

    public function withTitle(Title $title): self
    {
        $this->double()
            ->title = $title
        ;

        return $this;
    }

    public function withPrice(?Price $price): self
    {
        $this->double()
            ->price = $price
        ;

        return $this;
    }

    public function withAuthor(Author $author): self
    {
        $this->double()
            ->author = $author
        ;

        return $this;
    }

    public function withTags(TagListInput $tags): self
    {
        $this->double()
            ->tags = $tags
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->double()->title = $this->mock(Title::class)->reveal();

        $this->double()->price = $this->mock(Price::class)->reveal();

        $this->double()->author = $this->mock(Author::class)->reveal();

        $this->double()->tags = TagListInput::collect();
    }

    protected function classNameOrInterface(): string
    {
        return BookInput::class;
    }

    protected function double(): ObjectProphecy|BookInput
    {
        return $this->input;
    }
}
