<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Create;

use App\Media\Application\UseCase\Create\CreateMovie;
use App\Media\Application\UseCase\Create\CreateMovieUseCase;
use App\Media\Domain\Model\Movie;
use App\Media\Domain\Repository\MovieRepository;
use App\Media\Domain\Service\RateCalculator;
use PlanB\Framework\Testing\Test\FunctionalTest;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;

/**
 * @internal
 */
final class CreateMovieUseCaseTest extends FunctionalTest
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $rateCalculator = $this->stub(RateCalculator::class);
        $repository = $this->stub(MovieRepository::class);
        $useCase = new CreateMovieUseCase($repository, $rateCalculator);

        $this->assertInstanceOf(CreateMovieUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_creates_a_new_movie_properly()
    {
        $itemsAfter = $this->totalItems(Movie::class);

        $input = $this->loadData(Movie::class);

        $command = $this->denormalize($input, CreateMovie::class);

        $response = $this->handle($command);

        $itemsBefore = $this->totalItems(Movie::class);

        $this->assertInstanceOf(Movie::class, $response);
        $this->assertEquals($itemsBefore, $itemsAfter + 1);
    }
}
