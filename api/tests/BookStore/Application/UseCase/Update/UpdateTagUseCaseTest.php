<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\Update;

use App\BookStore\Application\UseCase\Update\UpdateTag;
use App\BookStore\Application\UseCase\Update\UpdateTagUseCase;
use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Model\TagId;
use App\BookStore\Domain\Repository\TagRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class UpdateTagUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $tagId = new TagId();

        $repository = $this->prophesize(TagRepository::class);
        $repository->findById($tagId)
            ->willReturn($this->doubleTag())
        ;

        $repository->save(Argument::type(Tag::class))
            ->shouldBeCalledOnce()
        ;

        $command = new UpdateTag($this->doubleTagInput(), $tagId);
        $useCase = new UpdateTagUseCase($repository->reveal());

        $useCase($command);
    }
}
