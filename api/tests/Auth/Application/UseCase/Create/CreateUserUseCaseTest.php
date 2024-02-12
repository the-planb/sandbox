<?php

declare(strict_types=1);

namespace App\Tests\Auth\Application\UseCase\Create;

use App\Auth\Application\UseCase\Create\CreateUser;
use App\Auth\Application\UseCase\Create\CreateUserUseCase;
use App\Auth\Domain\Model\User;
use App\Auth\Domain\Repository\UserRepository;
use App\Tests\Auth\Doubles\AuthTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class CreateUserUseCaseTest extends TestCase
{
    use AuthTrait;

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
