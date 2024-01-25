<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\Update;

use App\BookStore\Application\UseCase\Update\UpdateBook;
use App\BookStore\Application\UseCase\Update\UpdateBookUseCase;
use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Repository\BookRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class UpdateBookUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $bookId = new BookId();

        $repository = $this->prophesize(BookRepository::class);
        $repository->findById($bookId)
            ->willReturn($this->doubleBook())
        ;

        $repository->save(Argument::type(Book::class))
            ->shouldBeCalledOnce()
        ;

        $command = new UpdateBook($this->doubleBookInput(), $bookId);
        $useCase = new UpdateBookUseCase($repository->reveal());

        $useCase($command);
    }
}
