<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\State\Provider\FindById;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\FindById\FindGenreById;
use App\Media\Domain\Model\Genre;
use App\Media\Framework\Api\State\Provider\FindById\FindGenreByIdProvider;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use Prophecy\Argument;

/**
 * @internal
 */
final class FindGenreByIdProviderTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $commandBus = $this->stub(CommandBus::class);
        $provider = new FindGenreByIdProvider($commandBus);

        $this->assertInstanceOf(FindGenreByIdProvider::class, $provider);
        $this->assertInstanceOf(ProviderInterface::class, $provider);
    }

    public function test_it_provides_a_response_properly()
    {
        $commandBus = $this->mock(CommandBus::class);
        $commandBus
            ->handle(Argument::type(FindGenreById::class))
            ->shouldBeCalledOnce()
            ->willReturn($this->stub(Genre::class))
        ;

        $operation = $this->stub(Operation::class);

        $provider = new FindGenreByIdProvider($commandBus->reveal());
        $response = $provider->provide($operation, [
            'id' => $this->string()->uuid(),
        ]);

        $this->assertInstanceOf(Genre::class, $response);
    }
}
