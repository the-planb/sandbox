<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\State\Provider\FindById;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\FindById\FindDirectorById;
use App\Media\Domain\Model\Director;
use App\Media\Framework\Api\State\Provider\FindById\FindDirectorByIdProvider;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use Prophecy\Argument;

/**
 * @internal
 */
final class FindDirectorByIdProviderTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $commandBus = $this->stub(CommandBus::class);
        $provider = new FindDirectorByIdProvider($commandBus);

        $this->assertInstanceOf(FindDirectorByIdProvider::class, $provider);
        $this->assertInstanceOf(ProviderInterface::class, $provider);
    }

    public function test_it_provides_a_response_properly()
    {
        $commandBus = $this->mock(CommandBus::class);
        $commandBus
            ->handle(Argument::type(FindDirectorById::class))
            ->shouldBeCalledOnce()
            ->willReturn($this->stub(Director::class))
        ;

        $operation = $this->stub(Operation::class);

        $provider = new FindDirectorByIdProvider($commandBus->reveal());
        $response = $provider->provide($operation, [
            'id' => $this->string()->uuid(),
        ]);

        $this->assertInstanceOf(Director::class, $response);
    }
}
