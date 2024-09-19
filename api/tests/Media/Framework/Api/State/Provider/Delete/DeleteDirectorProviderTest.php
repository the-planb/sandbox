<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\State\Provider\Delete;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\Delete\DeleteDirector;
use App\Media\Domain\Model\DirectorId;
use App\Media\Framework\Api\State\Provider\Delete\DeleteDirectorProvider;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use Prophecy\Argument;

/**
 * @internal
 */
final class DeleteDirectorProviderTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $commandBus = $this->stub(CommandBus::class);
        $provider = new DeleteDirectorProvider($commandBus);

        $this->assertInstanceOf(DeleteDirectorProvider::class, $provider);
        $this->assertInstanceOf(ProviderInterface::class, $provider);
    }

    public function test_it_provides_a_response_properly()
    {
        $commandBus = $this->mock(CommandBus::class);
        $commandBus
            ->handle(Argument::type(DeleteDirector::class))
            ->shouldBeCalledOnce()
        ;

        $operation = $this->stub(Operation::class);

        $provider = new DeleteDirectorProvider($commandBus->reveal());
        $response = $provider->provide($operation, [
            'id' => $this->string()->uuid(),
        ]);

        $this->assertInstanceOf(DirectorId::class, $response);
    }
}
