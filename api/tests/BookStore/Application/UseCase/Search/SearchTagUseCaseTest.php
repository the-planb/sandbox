<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\Search;

use App\BookStore\Application\UseCase\Search\SearchTag;
use App\BookStore\Application\UseCase\Search\SearchTagUseCase;
use App\BookStore\Domain\Repository\TagRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;

/**
 * @internal
 */
class SearchTagUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $criteria = Criteria::empty();
        $repository = $this->prophesize(TagRepository::class);

        $repository->match($criteria)
            ->willReturn($this->doubleTagList())
            ->shouldBeCalledOnce()
        ;

        $command = new SearchTag($criteria);
        $useCase = new SearchTagUseCase($repository->reveal());

        $useCase($command);
    }
}
