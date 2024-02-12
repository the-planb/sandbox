<?php

declare(strict_types=1);

namespace App\Auth\Framework\Doctrine\Fixtures;

use App\Auth\Application\UseCase\Create\CreateUser;
use App\Auth\Domain\Input\UserInput;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

/**
 * @codeCoverageIgnore
 */
final class UserFixture extends UseCaseFixture // implements DependentFixtureInterface
{
    public function loadData(): void
    {
        $this->createMany(100, function (int $index) {
            //            $input = new UserInput();
            //
            //            $command = new CreateUser($input);
            //            return $this->handle($command);
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
