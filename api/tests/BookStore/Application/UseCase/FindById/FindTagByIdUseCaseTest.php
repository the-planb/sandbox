<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\FindById;

use App\BookStore\Application\UseCase\FindById\FindTagById;
use App\BookStore\Application\UseCase\FindById\FindTagByIdUseCase;
use App\BookStore\Domain\Model\TagId;
use App\BookStore\Domain\Repository\TagRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class FindTagByIdUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $tagId = new TagId();

        $repository = $this->prophesize(TagRepository::class);
        $repository->findById($tagId)
            ->shouldBeCalledOnce()
        ;

        $command = new FindTagById($tagId);
        $useCase = new FindTagByIdUseCase($repository->reveal());

        $useCase($command);
    }
}
