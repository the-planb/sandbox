<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\State\Processor\Update;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Media\Domain\Model\Genre;
use App\Media\Framework\Api\State\Processor\Update\UpdateGenreProcessor;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;

/**
 * @internal
 */
final class UpdateGenreProcessorTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $commandBus = $this->stub(CommandBus::class);
        $processor = new UpdateGenreProcessor($commandBus);

        $this->assertInstanceOf(UpdateGenreProcessor::class, $processor);
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

        $processor = new UpdateGenreProcessor($commandBus->reveal());
        $response = $processor->process($data, $operation, [], [
            'previous_data' => $this->stub(Genre::class),
        ]);
        $this->assertSame($expected, $response);
    }
}
