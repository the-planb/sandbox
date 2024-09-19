<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\State\Provider\FindById;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\FindById\FindMovieById;
use App\Media\Domain\Model\Movie;
use App\Media\Framework\Api\State\Provider\FindById\FindMovieByIdProvider;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use Prophecy\Argument;

/**
 * @internal
 */
final class FindMovieByIdProviderTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $commandBus = $this->stub(CommandBus::class);
        $provider = new FindMovieByIdProvider($commandBus);

        $this->assertInstanceOf(FindMovieByIdProvider::class, $provider);
        $this->assertInstanceOf(ProviderInterface::class, $provider);
    }

    public function test_it_provides_a_response_properly()
    {
        $commandBus = $this->mock(CommandBus::class);
        $commandBus
            ->handle(Argument::type(FindMovieById::class))
            ->shouldBeCalledOnce()
            ->willReturn($this->stub(Movie::class))
        ;

        $operation = $this->stub(Operation::class);

        $provider = new FindMovieByIdProvider($commandBus->reveal());
        $response = $provider->provide($operation, [
            'id' => $this->string()->uuid(),
        ]);

        $this->assertInstanceOf(Movie::class, $response);
    }
}
