<?php

declare(strict_types=1);

namespace App\Tests\Auth\Application\UseCase\FindById;

use App\Auth\Application\UseCase\FindById\FindUserById;
use App\Auth\Application\UseCase\FindById\FindUserByIdUseCase;
use App\Auth\Domain\Model\UserId;
use App\Auth\Domain\Repository\UserRepository;
use App\Tests\Auth\Doubles\AuthTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class FindUserByIdUseCaseTest extends TestCase
{
    use AuthTrait;

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
