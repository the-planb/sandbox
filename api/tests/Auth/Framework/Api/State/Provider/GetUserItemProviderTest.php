<?php

declare(strict_types=1);

namespace App\Tests\Auth\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use App\Auth\Application\UseCase\FindById\FindUserById;
use App\Auth\Framework\Api\State\Provider\GetUserItemProvider;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 */
class GetUserItemProviderTest extends TestCase
{
    use ProphecyTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(FindUserById::class))
            ->shouldBeCalledOnce()
        ;

        $id = '018d92bf-2777-48f1-46ac-8bcc98827965';
        $provider = new GetUserItemProvider($commandBus->reveal());
        $provider->provide($operation->reveal(), ['id' => $id]);
    }
}
