<?php

declare(strict_types=1);

namespace App\Tests\Music\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use App\Music\Application\UseCase\Delete\DeleteDisco;
use App\Music\Framework\Api\State\Processor\DeleteDiscoProcessor;
use App\Tests\Music\Doubles\MusicTrait;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class DeleteDiscoProcessorTest extends TestCase
{
    use MusicTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);
        $commandBus->handle(Argument::type(DeleteDisco::class))
            ->shouldBeCalledOnce()
        ;

        $context['previous_data'] = $this->doubleDisco();

        $processor = new DeleteDiscoProcessor($commandBus->reveal());
        $processor->process(null, $operation->reveal(), [], $context);
    }
}
