<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\Fixtures;

use App\Media\Application\UseCase\Create\CreateDirector;
use App\Media\Domain\Input\DirectorInput;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

final class DirectorFixture extends UseCaseFixture
{
    // implements DependentFixtureInterface

    public function loadData(): void
    {
        $directors = ['Steven Spielberg', 'Margin Scorsese', 'George Lucas', 'David Fincher', 'George Miller', 'Denis Villeneuve'];

        $this->createRange($directors, function (string $name) {
            $input = $this->denormalize([
                'name' => $name,
                'movies' => [],
            ], DirectorInput::class);

            $command = new CreateDirector($input);

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
