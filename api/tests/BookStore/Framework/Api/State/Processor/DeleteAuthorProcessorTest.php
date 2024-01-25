<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use App\BookStore\Application\UseCase\Delete\DeleteAuthor;
use App\BookStore\Framework\Api\State\Processor\DeleteAuthorProcessor;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class DeleteAuthorProcessorTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);
        $commandBus->handle(Argument::type(DeleteAuthor::class))
            ->shouldBeCalledOnce()
        ;

        $context['previous_data'] = $this->doubleAuthor();

        $processor = new DeleteAuthorProcessor($commandBus->reveal());
        $processor->process(null, $operation->reveal(), [], $context);
    }
}
