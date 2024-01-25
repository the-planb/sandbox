<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\Create;

use App\BookStore\Application\UseCase\Create\CreateBook;
use App\BookStore\Application\UseCase\Create\CreateBookUseCase;
use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Repository\BookRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class CreateBookUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $repository = $this->prophesize(BookRepository::class);

        $repository->save(Argument::type(Book::class))
            ->shouldBeCalledOnce()
        ;

        $command = new CreateBook($this->doubleBookInput());
        $useCase = new CreateBookUseCase($repository->reveal());

        $useCase($command);
    }
}
