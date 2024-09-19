<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Update;

use App\Media\Application\UseCase\Update\UpdateMovie;
use App\Media\Application\UseCase\Update\UpdateMovieUseCase;
use App\Media\Domain\Input\GenreListInput;
use App\Media\Domain\Input\ReviewListInput;
use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\Movie;
use App\Media\Domain\Model\MovieId;
use App\Media\Domain\Model\VO\Classification;
use App\Media\Domain\Model\VO\MovieTitle;
use App\Media\Domain\Model\VO\Overview;
use App\Media\Domain\Model\VO\ReleaseYear;
use App\Media\Domain\Model\VO\Score;
use App\Media\Domain\Repository\MovieRepository;
use App\Media\Domain\Service\RateCalculator;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class UpdateMovieUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $rateCalculator = $this->stub(RateCalculator::class);
        $repository = $this->stub(MovieRepository::class);
        $useCase = new UpdateMovieUseCase($repository, $rateCalculator);

        $this->assertInstanceOf(UpdateMovieUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_updates_an_existing_movie_properly()
    {
        $command = $this->commandDummy();

        $movie = $this->stub(Movie::class);
        $repository = $this->mock(MovieRepository::class);
        $repository->findById(Argument::type(MovieId::class))
            ->willReturn($movie)
        ;

        $repository->save(Argument::type(Movie::class))
            ->shouldBeCalled()
        ;

        $repository = $repository->reveal();

        $rateCalculator = $this->stub(RateCalculator::class);

        $useCase = new UpdateMovieUseCase($repository, $rateCalculator);
        $useCase->__invoke($command);
    }

    public function commandDummy(): UpdateMovie
    {
        $command = new UpdateMovie();
        $command->id = new MovieId();
        $command->title = $this->dummy(MovieTitle::class);
        $command->releaseYear = $this->dummy(ReleaseYear::class);
        $command->director = $this->dummy(Director::class);
        $command->overview = $this->dummy(Overview::class);
        $command->classification = $this->dummy(Classification::class);
        $command->raw = $this->dummy(Score::class);
        $command->reviews = $this->stub(ReviewListInput::class);
        $command->genres = $this->stub(GenreListInput::class);

        return $command;
    }
}
