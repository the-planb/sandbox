<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use App\BookStore\Application\UseCase\Update\UpdateBook;
use App\BookStore\Framework\Api\State\Processor\UpdateBookProcessor;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class UpdateBookProcessorTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);
        $commandBus->handle(Argument::type(UpdateBook::class))
            ->shouldBeCalledOnce()
        ;

        $data = $this->doubleBookInput();

        $context['previous_data'] = $this->doubleBook();

        $processor = new UpdateBookProcessor($commandBus->reveal());
        $processor->process($data, $operation->reveal(), [], $context);
    }

    public function test_it_throws_an_exception_when_input_is_incorrect()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(UpdateBook::class))
            ->shouldNotBeCalled()
        ;

        $data = new \stdClass();
        $processor = new UpdateBookProcessor($commandBus->reveal());

        $this->expectException(\AssertionError::class);
        $processor->process($data, $operation->reveal());
    }
}
