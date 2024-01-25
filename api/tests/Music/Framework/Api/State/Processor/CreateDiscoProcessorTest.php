<?php

declare(strict_types=1);

namespace App\Tests\Music\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use App\Music\Application\UseCase\Create\CreateDisco;
use App\Music\Framework\Api\State\Processor\CreateDiscoProcessor;
use App\Tests\Music\Doubles\MusicTrait;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class CreateDiscoProcessorTest extends TestCase
{
    use MusicTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(CreateDisco::class))
            ->shouldBeCalledOnce()
        ;

        $data = $this->doubleDiscoInput();

        $processor = new CreateDiscoProcessor($commandBus->reveal());
        $processor->process($data, $operation->reveal());
    }

    public function test_it_throws_an_exception_when_input_is_incorrect()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(CreateDisco::class))
            ->shouldNotBeCalled()
        ;

        $data = new \stdClass();
        $processor = new CreateDiscoProcessor($commandBus->reveal());

        $this->expectException(\AssertionError::class);
        $processor->process($data, $operation->reveal());
    }
}
