<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Input;

use App\BookStore\Domain\Input\AuthorInput;
use App\BookStore\Domain\Model\AuthorId;
use App\BookStore\Domain\Model\VO\FullName;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class AuthorInputDouble extends Double
{
    private AuthorInput $input;

    public function __construct(callable $prophesize, callable $configurator = null)
    {
        $this->input = new AuthorInput();
        parent::__construct($prophesize, $configurator);
    }

    public function reveal(): AuthorInput
    {
        return $this->input;
    }

    public function withId(AuthorId $id): self
    {
        $this->double()
            ->id = $id
        ;

        return $this;
    }

    public function withName(FullName $name): self
    {
        $this->double()
            ->name = $name
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->double()->name = $this->mock(FullName::class)->reveal();
    }

    protected function classNameOrInterface(): string
    {
        return AuthorInput::class;
    }

    protected function double(): ObjectProphecy|AuthorInput
    {
        return $this->input;
    }
}
