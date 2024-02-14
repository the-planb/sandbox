<?php

declare(strict_types=1);

namespace App\Tests\Staff\Application\UseCase\Update;

use App\Staff\Application\UseCase\Update\UpdateUser;
use App\Staff\Application\UseCase\Update\UpdateUserUseCase;
use App\Staff\Domain\Model\User;
use App\Staff\Domain\Model\UserId;
use App\Staff\Domain\Repository\UserRepository;
use App\Tests\Staff\Doubles\StaffTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class UpdateUserUseCaseTest extends TestCase
{
    use StaffTrait;

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
