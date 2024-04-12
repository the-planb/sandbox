<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\Fixtures;

use App\Media\Application\UseCase\Create\CreateMovie;
use App\Media\Domain\Input\MovieInput;
use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\Genre;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

final class MovieFixture extends UseCaseFixture implements DependentFixtureInterface
{
    public function loadData(): void
    {
        $this->createMany(35, function (int $index) {
            $reviews = $this->createMany(3, function (int $index) {
                return [
                    'review' => $this->faker->sentence(),
                    'score' => $this->faker->randomNumber(1),
                ];
            });

            $input = $this->denormalize([
                'title' => $this->faker->words(4, true),
                'releaseYear' => $this->faker->numberBetween(1900, 2024),
                'director' => $this->getOneReferenceLikeIri(Director::class),
                'reviews' => $reviews,
                'genres' => $this->getManyReferencesLikeIri(Genre::class, 2, 3),
                'overview' => $this->faker->sentences(3, true),
            ], MovieInput::class);

            $command = new CreateMovie($input);

            return $this->handle($command);
        });
    }

    public function getDependencies()
    {
        return [GenreFixture::class, DirectorFixture::class];
    }

    public function allowedEnvironments(): array
    {
        return ['dev'];
    }
}
