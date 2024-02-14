<?php

declare(strict_types=1);

namespace App\Tests\Staff\Application\UseCase\Delete;

use App\Staff\Application\UseCase\Delete\DeleteUser;
use App\Staff\Application\UseCase\Delete\DeleteUserUseCase;
use App\Staff\Domain\Model\UserId;
use App\Staff\Domain\Repository\UserRepository;
use App\Tests\Staff\Doubles\StaffTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class DeleteUserUseCaseTest extends TestCase
{
    use StaffTrait;

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
