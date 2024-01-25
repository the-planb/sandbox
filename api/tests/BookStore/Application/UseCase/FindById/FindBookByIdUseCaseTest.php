<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\FindById;

use App\BookStore\Application\UseCase\FindById\FindBookById;
use App\BookStore\Application\UseCase\FindById\FindBookByIdUseCase;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Repository\BookRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class FindBookByIdUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $bookId = new BookId();

        $repository = $this->prophesize(BookRepository::class);
        $repository->findById($bookId)
            ->shouldBeCalledOnce()
        ;

        $command = new FindBookById($bookId);
        $useCase = new FindBookByIdUseCase($repository->reveal());

        $useCase($command);
    }
}
