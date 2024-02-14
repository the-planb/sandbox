<?php

declare(strict_types=1);

namespace App\Tests\Staff\Application\UseCase\FindById;

use App\Staff\Application\UseCase\FindById\FindUserById;
use App\Staff\Application\UseCase\FindById\FindUserByIdUseCase;
use App\Staff\Domain\Model\UserId;
use App\Staff\Domain\Repository\UserRepository;
use App\Tests\Staff\Doubles\StaffTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class FindUserByIdUseCaseTest extends TestCase
{
    use StaffTrait;

    public function test_it_execute_the_command_properly()
    {
        $userId = new UserId();

        $repository = $this->prophesize(UserRepository::class);
        $repository->findById($userId)
            ->shouldBeCalledOnce()
        ;

        $command = new FindUserById($userId);
        $useCase = new FindUserByIdUseCase($repository->reveal());

        $useCase($command);
    }
}
