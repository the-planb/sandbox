<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Provider\Delete;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\Delete\DeleteGenre;
use App\Media\Domain\Model\GenreId;
use League\Tactician\CommandBus;

final class DeleteGenreProvider implements ProviderInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $genreId = new GenreId($uriVariables['id']);
        $command = new DeleteGenre($genreId);
        $this->commandBus->handle($command);

        return $genreId;
    }
}
