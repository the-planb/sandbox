<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Provider\Search;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\Search\SearchMovie;
use App\Media\Domain\Repository\MovieRepository;
use League\Tactician\CommandBus;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Api\State\Pagination\CriteriaPaginator;

final class SearchMovieProvider implements ProviderInterface
{
	private CommandBus $commandBus;
	private MovieRepository $repository;

	public function __construct(CommandBus $commandBus, MovieRepository $repository)
	{
		$this->commandBus = $commandBus;
		$this->repository = $repository;
	}

	public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
	{
		$filters = $context['filters'] ?? [];
		$criteria = Criteria::fromValues($filters);
		$pagination = $criteria->getPagination();

		$command = new SearchMovie($criteria);

		$data = $this->commandBus->handle($command);

		return new CriteriaPaginator(
			$data,
			$pagination->getCurrentPage(),
			$pagination->getMaxResults(),
			$this->repository->totalItems($criteria)
		);
	}
}
