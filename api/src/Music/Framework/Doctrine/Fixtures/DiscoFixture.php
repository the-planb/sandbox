<?php

declare(strict_types=1);

namespace App\Music\Framework\Doctrine\Fixtures;

use App\Music\Application\Input\DiscoInput;
use App\Music\Application\UseCase\Create\CreateDisco;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

final class DiscoFixture extends UseCaseFixture // implements DependentFixtureInterface
{
    public function loadData(): void
    {
        $this->createMany(100, function (int $index) {
            $input = new DiscoInput();

            $command = new CreateDisco($input);

            return $this->handle($command);
        });
    }

    //    public function getDependencies()
    //    {
    //        return [OtherFixture];
    //    }

    protected function allowedEnvironments(): array
    {
        return ['dev'];
    }
}
