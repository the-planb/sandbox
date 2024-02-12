<?php

declare(strict_types=1);

namespace App\Tests\Auth\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use App\Auth\Application\UseCase\Create\CreateUser;
use App\Auth\Framework\Api\State\Processor\CreateUserProcessor;
use App\Tests\Auth\Doubles\AuthTrait;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class CreateUserProcessorTest extends TestCase
{
    use AuthTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(CreateUser::class))
            ->shouldBeCalledOnce()
        ;

        $data = $this->doubleUserInput();

        $processor = new CreateUserProcessor($commandBus->reveal());
        $processor->process($data, $operation->reveal());
    }

    public function test_it_throws_an_exception_when_input_is_incorrect()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(CreateUser::class))
            ->shouldNotBeCalled()
        ;

        $data = new \stdClass();
        $processor = new CreateUserProcessor($commandBus->reveal());

        $this->expectException(\AssertionError::class);
        $processor->process($data, $operation->reveal());
    }
}
