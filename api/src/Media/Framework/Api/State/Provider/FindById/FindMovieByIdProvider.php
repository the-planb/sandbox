<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Provider\FindById;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\FindById\FindMovieById;
use App\Media\Domain\Model\MovieId;
use League\Tactician\CommandBus;

final class FindMovieByIdProvider implements ProviderInterface
{
	private CommandBus $commandBus;

	public function __construct(CommandBus $commandBus)
	{
		$this->commandBus = $commandBus;
	}

	public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
	{
		$id = $uriVariables['id'];
		$movieId = new MovieId($id);

		$command = new FindMovieById($movieId);

		return $this->commandBus->handle($command);
	}
}
