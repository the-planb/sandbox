<?php

declare(strict_types=1);

namespace App\Tests\Auth\Application\UseCase\Search;

use App\Auth\Application\UseCase\Search\SearchUser;
use App\Auth\Application\UseCase\Search\SearchUserUseCase;
use App\Auth\Domain\Repository\UserRepository;
use App\Tests\Auth\Doubles\AuthTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;

/**
 * @internal
 */
class SearchUserUseCaseTest extends TestCase
{
    use AuthTrait;

    public function test_it_execute_the_command_properly()
    {
        $criteria = Criteria::empty();
        $repository = $this->prophesize(UserRepository::class);

        $repository->match($criteria)
            ->willReturn($this->doubleUserList())
            ->shouldBeCalledOnce()
        ;

        $command = new SearchUser($criteria);
        $useCase = new SearchUserUseCase($repository->reveal());

        $useCase($command);
    }
}
