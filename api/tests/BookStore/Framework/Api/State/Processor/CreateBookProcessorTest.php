<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use App\BookStore\Application\UseCase\Create\CreateBook;
use App\BookStore\Framework\Api\State\Processor\CreateBookProcessor;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class CreateBookProcessorTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(CreateBook::class))
            ->shouldBeCalledOnce()
        ;

        $data = $this->doubleBookInput();

        $processor = new CreateBookProcessor($commandBus->reveal());
        $processor->process($data, $operation->reveal());
    }

    public function test_it_throws_an_exception_when_input_is_incorrect()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(CreateBook::class))
            ->shouldNotBeCalled()
        ;

        $data = new \stdClass();
        $processor = new CreateBookProcessor($commandBus->reveal());

        $this->expectException(\AssertionError::class);
        $processor->process($data, $operation->reveal());
    }
}
