<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Create;

use App\Media\Application\UseCase\Create\CreateMovie;
use App\Media\Application\UseCase\Create\CreateMovieUseCase;
use App\Media\Domain\Input\GenreListInput;
use App\Media\Domain\Input\ReviewListInput;
use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\Movie;
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
final class CreateMovieUseCaseTest extends TestCase
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
        $command = $this->commandDummy();

        $repository = $this->mock(MovieRepository::class);
        $repository->save(Argument::type(Movie::class))
            ->shouldBeCalled()
        ;
        $repository = $repository->reveal();

        $rateCalculator = $this->mock(RateCalculator::class);
        $rateCalculator->__invoke(Argument::cetera())
            ->shouldBeCalledOnce()
        ;
        $rateCalculator = $rateCalculator->reveal();

        $useCase = new CreateMovieUseCase($repository, $rateCalculator);
        $useCase->__invoke($command);
    }

    public function commandDummy(): CreateMovie
    {
        $command = new CreateMovie();
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
