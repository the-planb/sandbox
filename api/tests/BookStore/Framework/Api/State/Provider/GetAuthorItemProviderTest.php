<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use App\BookStore\Application\UseCase\FindById\FindAuthorById;
use App\BookStore\Framework\Api\State\Provider\GetAuthorItemProvider;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 */
class GetAuthorItemProviderTest extends TestCase
{
    use ProphecyTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(FindAuthorById::class))
            ->shouldBeCalledOnce()
        ;

        $id = '018d92bf-2777-48f1-46ac-8bcc98827965';
        $provider = new GetAuthorItemProvider($commandBus->reveal());
        $provider->provide($operation->reveal(), ['id' => $id]);
    }
}
