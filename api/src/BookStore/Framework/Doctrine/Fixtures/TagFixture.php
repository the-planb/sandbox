<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\Fixtures;

use App\BookStore\Application\UseCase\Create\CreateTag;
use App\BookStore\Domain\Input\TagInput;
use App\BookStore\Domain\Model\VO\TagName;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

/**
 * @codeCoverageIgnore
 */
final class TagFixture extends UseCaseFixture // implements DependentFixtureInterface
{
    public function loadData(): void
    {
        $this->createMany(20, function (int $index) {
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

    public function allowedEnvironments(): array
    {
        return ['dev'];
    }
}
