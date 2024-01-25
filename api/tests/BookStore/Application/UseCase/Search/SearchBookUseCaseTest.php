<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\Search;

use App\BookStore\Application\UseCase\Search\SearchBook;
use App\BookStore\Application\UseCase\Search\SearchBookUseCase;
use App\BookStore\Domain\Repository\BookRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;

/**
 * @internal
 */
class SearchBookUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $criteria = Criteria::empty();
        $repository = $this->prophesize(BookRepository::class);

        $repository->match($criteria)
            ->willReturn($this->doubleBookList())
            ->shouldBeCalledOnce()
        ;

        $command = new SearchBook($criteria);
        $useCase = new SearchBookUseCase($repository->reveal());

        $useCase($command);
    }
}
