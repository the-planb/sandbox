<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\State\Processor\Update;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Media\Domain\Model\Movie;
use App\Media\Framework\Api\State\Processor\Update\UpdateMovieProcessor;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;

/**
 * @internal
 */
final class UpdateMovieProcessorTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $commandBus = $this->stub(CommandBus::class);
        $processor = new UpdateMovieProcessor($commandBus);

        $this->assertInstanceOf(UpdateMovieProcessor::class, $processor);
        $this->assertInstanceOf(ProcessorInterface::class, $processor);
    }

    public function test_it_process_a_request_properly()
    {
        $data = $this->any();
        $expected = $this->any();

        $commandBus = $this->mock(CommandBus::class);
        $commandBus->handle($data)
            ->shouldBeCalledOnce()
            ->willReturn($expected)
        ;

        $operation = $this->stub(Operation::class);

        $processor = new UpdateMovieProcessor($commandBus->reveal());
        $response = $processor->process($data, $operation, [], [
            'previous_data' => $this->stub(Movie::class),
        ]);
        $this->assertSame($expected, $response);
    }
}
