<?php

declare(strict_types=1);

namespace App\Tests;

use App\Media\Application\UseCase\Search\SearchDirector;
use App\Media\Application\UseCase\Search\SearchGenre;
use App\Media\Application\UseCase\Search\SearchMovie;
use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\Genre;
use App\Media\Domain\Model\Movie;
use PlanB\Framework\Testing\DataFactory\AbstractDataFactory;

final class DataFactory extends AbstractDataFactory
{
    protected function getCommandList(): array
    {
        $criteria = $this->getCriteria();

        return [
            Genre::class => new SearchGenre($criteria),
            Movie::class => new SearchMovie($criteria),
            Director::class => new SearchDirector($criteria),
        ];
    }
}
