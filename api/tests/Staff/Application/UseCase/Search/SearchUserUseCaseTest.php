<?php

declare(strict_types=1);

namespace App\Tests\Staff\Application\UseCase\Search;

use App\Staff\Application\UseCase\Search\SearchUser;
use App\Staff\Application\UseCase\Search\SearchUserUseCase;
use App\Staff\Domain\Repository\UserRepository;
use App\Tests\Staff\Doubles\StaffTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;

/**
 * @internal
 */
class SearchUserUseCaseTest extends TestCase
{
    use StaffTrait;

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
