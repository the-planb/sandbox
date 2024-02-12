<?php

declare(strict_types=1);

namespace App\Tests\Auth\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use App\Auth\Application\UseCase\Delete\DeleteUser;
use App\Auth\Framework\Api\State\Processor\DeleteUserProcessor;
use App\Tests\Auth\Doubles\AuthTrait;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class DeleteUserProcessorTest extends TestCase
{
    use AuthTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);
        $commandBus->handle(Argument::type(DeleteUser::class))
            ->shouldBeCalledOnce()
        ;

        $context['previous_data'] = $this->doubleUser();

        $processor = new DeleteUserProcessor($commandBus->reveal());
        $processor->process(null, $operation->reveal(), [], $context);
    }
}
