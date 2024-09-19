<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\State\Provider\Delete;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\Delete\DeleteGenre;
use App\Media\Domain\Model\GenreId;
use App\Media\Framework\Api\State\Provider\Delete\DeleteGenreProvider;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use Prophecy\Argument;

/**
 * @internal
 */
final class DeleteGenreProviderTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $commandBus = $this->stub(CommandBus::class);
        $provider = new DeleteGenreProvider($commandBus);

        $this->assertInstanceOf(DeleteGenreProvider::class, $provider);
        $this->assertInstanceOf(ProviderInterface::class, $provider);
    }

    public function test_it_provides_a_response_properly()
    {
        $commandBus = $this->mock(CommandBus::class);
        $commandBus
            ->handle(Argument::type(DeleteGenre::class))
            ->shouldBeCalledOnce()
        ;

        $operation = $this->stub(Operation::class);

        $provider = new DeleteGenreProvider($commandBus->reveal());
        $response = $provider->provide($operation, [
            'id' => $this->string()->uuid(),
        ]);

        $this->assertInstanceOf(GenreId::class, $response);
    }
}
