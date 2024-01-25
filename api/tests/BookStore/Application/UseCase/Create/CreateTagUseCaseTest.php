<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\Create;

use App\BookStore\Application\UseCase\Create\CreateTag;
use App\BookStore\Application\UseCase\Create\CreateTagUseCase;
use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Repository\TagRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class CreateTagUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $repository = $this->prophesize(TagRepository::class);

        $repository->save(Argument::type(Tag::class))
            ->shouldBeCalledOnce()
        ;

        $command = new CreateTag($this->doubleTagInput());
        $useCase = new CreateTagUseCase($repository->reveal());

        $useCase($command);
    }
}
