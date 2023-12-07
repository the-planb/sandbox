<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\Fixtures;

use App\BookStore\Application\Input\TagInput;
use App\BookStore\Application\UseCase\Create\CreateTag;
use App\BookStore\Domain\Model\VO\TagName;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

final class TagFixture extends UseCaseFixture // implements DependentFixtureInterface
{
    public function loadData(): void
    {
        $this->createMany(5, function (int $index) {
            $input = new TagInput();
            $input->name = new TagName(sprintf('tag %02d', $index));

            $command = new CreateTag($input);

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
