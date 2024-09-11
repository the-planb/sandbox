<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\Fixtures;

use App\Media\Application\UseCase\Create\CreateMovie;
use App\Media\Domain\Model\Director;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;
use Symfony\Component\Yaml\Yaml;

class MovieFixture extends UseCaseFixture implements DependentFixtureInterface
{
    public function loadData(): void
    {
        $data = Yaml::parseFile(__DIR__.'/data/movies.yaml');
        $this->createRange($data, function (array $input) {
            $command = $this->denormalize([
                'title' => $input['title'],
                'releaseYear' => $input['releaseYear'],
                'overview' => $input['overview'],

                'director' => $this->getOneReferenceLikeIri(Director::class),
            ], CreateMovie::class);

            return $this->handle($command);
        });
    }

    public function allowedEnvironments(): array
    {
        return ['dev'];
    }

    public function getDependencies()
    {
        return [
            DirectorFixture::class,
        ];
    }
}
