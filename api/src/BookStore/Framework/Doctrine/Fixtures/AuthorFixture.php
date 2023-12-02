<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\Fixtures;

use App\BookStore\Application\Input\AuthorInput;
use App\BookStore\Application\UseCase\Create\CreateAuthor;
use App\BookStore\Domain\Model\VO\FullName;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

final class AuthorFixture extends UseCaseFixture // implements DependentFixtureInterface
{
    public function loadData(): void
    {
        $this->createMany(25, function (int $index) {
            $input = new AuthorInput();
            $input->name = new FullName(
                firstName: $this->faker->firstName,
                lastName: $this->faker->lastName,
            );

            $command = new CreateAuthor($input);

            return $this->handle($command);
        });
    }

    //    public function getDependencies()
    //    {
    //        return [];
    //    }

    protected function allowedEnvironments(): array
    {
        return ['dev'];
    }
}
