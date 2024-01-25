<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\Delete;

use App\BookStore\Application\UseCase\Delete\DeleteBook;
use App\BookStore\Application\UseCase\Delete\DeleteBookUseCase;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Repository\BookRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class DeleteBookUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $bookId = new BookId();
        $repository = $this->prophesize(BookRepository::class);
        $repository->delete($bookId)
            ->shouldBeCalledOnce()
        ;

        $command = new DeleteBook($bookId);
        $useCase = new DeleteBookUseCase($repository->reveal());

        $useCase($command);
    }
}
