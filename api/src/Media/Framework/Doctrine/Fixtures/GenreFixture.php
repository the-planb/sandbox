<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\Fixtures;

use App\Media\Application\UseCase\Create\CreateGenre;
use App\Media\Domain\Input\GenreInput;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

final class GenreFixture extends UseCaseFixture
{
    // implements DependentFixtureInterface

    public function loadData(): void
    {
        $genres = ['terror', 'musical', 'misterio', 'comedia', 'drama', 'acción', 'romantica'];
        $this->createRange($genres, function (string $genre) {
            $input = $this->denormalize([
                'name' => $genre,
            ], GenreInput::class);

            $command = new CreateGenre($input);

            return $this->handle($command);
        });
    }

    //    public function getDependencies()
    //    {
    //        return [OtherFixture];
    //    }

    public function allowedEnvironments(): array
    {
        return ['dev'];
    }
}
