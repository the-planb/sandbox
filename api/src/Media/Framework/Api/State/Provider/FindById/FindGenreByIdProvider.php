<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Provider\FindById;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\FindById\FindGenreById;
use App\Media\Domain\Model\GenreId;
use League\Tactician\CommandBus;

final class FindGenreByIdProvider implements ProviderInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $id = $uriVariables['id'];
        $genreId = new GenreId($id);

        $command = new FindGenreById($genreId);

        return $this->commandBus->handle($command);
    }
}
