<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use App\BookStore\Application\UseCase\Create\CreateAuthor;
use App\BookStore\Framework\Api\State\Processor\CreateAuthorProcessor;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class CreateAuthorProcessorTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(CreateAuthor::class))
            ->shouldBeCalledOnce()
        ;

        $data = $this->doubleAuthorInput();

        $processor = new CreateAuthorProcessor($commandBus->reveal());
        $processor->process($data, $operation->reveal());
    }

    public function test_it_throws_an_exception_when_input_is_incorrect()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(CreateAuthor::class))
            ->shouldNotBeCalled()
        ;

        $data = new \stdClass();
        $processor = new CreateAuthorProcessor($commandBus->reveal());

        $this->expectException(\AssertionError::class);
        $processor->process($data, $operation->reveal());
    }
}
