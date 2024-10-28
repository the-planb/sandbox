<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Provider\Delete;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\Delete\DeleteMovie;
use App\Media\Domain\Model\MovieId;
use League\Tactician\CommandBus;

final class DeleteMovieProvider implements ProviderInterface
{
	private CommandBus $commandBus;

	public function __construct(CommandBus $commandBus)
	{
		$this->commandBus = $commandBus;
	}

	public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
	{
		$movieId = new MovieId($uriVariables['id']);
		$command = new DeleteMovie($movieId);
		$this->commandBus->handle($command);

		return $movieId;
	}
}
