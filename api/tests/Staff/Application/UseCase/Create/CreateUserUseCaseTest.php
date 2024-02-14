<?php

declare(strict_types=1);

namespace App\Tests\Staff\Application\UseCase\Create;

use App\Staff\Application\UseCase\Create\CreateUser;
use App\Staff\Application\UseCase\Create\CreateUserUseCase;
use App\Staff\Domain\Model\User;
use App\Staff\Domain\Repository\UserRepository;
use App\Tests\Staff\Doubles\StaffTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class CreateUserUseCaseTest extends TestCase
{
    use StaffTrait;

    public function test_it_execute_the_command_properly()
    {
        $repository = $this->prophesize(UserRepository::class);

        $repository->save(Argument::type(User::class))
            ->shouldBeCalledOnce()
        ;

        $command = new CreateUser($this->doubleUserInput());
        $useCase = new CreateUserUseCase($repository->reveal());

        $useCase($command);
    }
}
