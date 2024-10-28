<?php

declare(strict_types=1);

namespace App\Auth\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Auth\Application\UseCase\Delete\DeleteUser;
use League\Tactician\CommandBus;

final class DeleteUserProcessor implements ProcessorInterface
{
	private CommandBus $commandBus;

	public function __construct(CommandBus $commandBus)
	{
		$this->commandBus = $commandBus;
	}

	public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
	{
		$userId = $context['previous_data']->getId();

		$command = new DeleteUser($userId);

		return $this->commandBus->handle($command);
	}
}
