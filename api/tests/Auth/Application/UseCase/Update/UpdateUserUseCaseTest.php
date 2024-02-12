<?php

declare(strict_types=1);

namespace App\Tests\Auth\Application\UseCase\Update;

use App\Auth\Application\UseCase\Update\UpdateUser;
use App\Auth\Application\UseCase\Update\UpdateUserUseCase;
use App\Auth\Domain\Model\User;
use App\Auth\Domain\Model\UserId;
use App\Auth\Domain\Repository\UserRepository;
use App\Tests\Auth\Doubles\AuthTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class UpdateUserUseCaseTest extends TestCase
{
    use AuthTrait;

    public function test_it_execute_the_command_properly()
    {
        $userId = new UserId();

        $repository = $this->prophesize(UserRepository::class);
        $repository->findById($userId)
            ->willReturn($this->doubleUser())
        ;

        $repository->save(Argument::type(User::class))
            ->shouldBeCalledOnce()
        ;

        $command = new UpdateUser($this->doubleUserInput(), $userId);
        $useCase = new UpdateUserUseCase($repository->reveal());

        $useCase($command);
    }
}
