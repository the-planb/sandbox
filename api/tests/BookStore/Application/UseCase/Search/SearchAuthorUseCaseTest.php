<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\Search;

use App\BookStore\Application\UseCase\Search\SearchAuthor;
use App\BookStore\Application\UseCase\Search\SearchAuthorUseCase;
use App\BookStore\Domain\Repository\AuthorRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;

/**
 * @internal
 */
class SearchAuthorUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $criteria = Criteria::empty();
        $repository = $this->prophesize(AuthorRepository::class);

        $repository->match($criteria)
            ->willReturn($this->doubleAuthorList())
            ->shouldBeCalledOnce()
        ;

        $command = new SearchAuthor($criteria);
        $useCase = new SearchAuthorUseCase($repository->reveal());

        $useCase($command);
    }
}
