<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\Fixtures;

use App\BookStore\Application\UseCase\Create\CreateBook;
use App\BookStore\Domain\Input\BookInput;
use App\BookStore\Domain\Input\TagListInput;
use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\Title;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

final class BookFixture extends UseCaseFixture implements DependentFixtureInterface
{
    public function loadData(): void
    {
        $this->createMany(500, function (int $index) {
            $input = new BookInput();
            $input->title = new Title(sprintf('libro num. %02d', $index));
            $input->price = new Price(rand(10, 25));
            $input->tags = TagListInput::collect($this->getSomeReferences(Tag::class, 2, 4));
            $input->author = $this->getOneReference(Author::class);

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

    public function allowedEnvironments(): array
    {
        return ['dev'];
    }
}
