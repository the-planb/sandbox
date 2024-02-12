<?php

declare(strict_types=1);

namespace App\Tests\Auth\Application\UseCase\Delete;

use App\Auth\Application\UseCase\Delete\DeleteUser;
use App\Auth\Application\UseCase\Delete\DeleteUserUseCase;
use App\Auth\Domain\Model\UserId;
use App\Auth\Domain\Repository\UserRepository;
use App\Tests\Auth\Doubles\AuthTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class DeleteUserUseCaseTest extends TestCase
{
    use AuthTrait;

    public function test_it_execute_the_command_properly()
    {
        $userId = new UserId();
        $repository = $this->prophesize(UserRepository::class);
        $repository->delete($userId)
            ->shouldBeCalledOnce()
        ;

        $command = new DeleteUser($userId);
        $useCase = new DeleteUserUseCase($repository->reveal());

        $useCase($command);
    }
}
