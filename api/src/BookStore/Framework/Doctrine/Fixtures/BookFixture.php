<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\Fixtures;

use App\BookStore\Application\Input\BookInput;
use App\BookStore\Application\UseCase\Create\CreateBook;
use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Model\TagList;
use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\Title;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

final class BookFixture extends UseCaseFixture implements DependentFixtureInterface
{
    public function loadData(): void
    {
        $this->createMany(100, function (int $index) {
            $title = sprintf('libro num. %02d', $index);
            $input = new BookInput();
            $input->title = new Title($title);
            $input->price = new Price($this->faker->numberBetween(10, 60));
            $input->tags = TagList::collect([
                $this->getReference($this->referenceName(Tag::class, rand(0, 4))),
            ]);

            $input->author = $this->getReference($this->referenceName(Author::class, rand(0, 9)));

            $command = new CreateBook($input);

            return $this->handle($command);
        });
    }

    public function getDependencies()
    {
        return [
            TagFixture::class,
            AuthorFixture::class,
        ];
    }

    protected function allowedEnvironments(): array
    {
        return ['dev'];
    }
}
