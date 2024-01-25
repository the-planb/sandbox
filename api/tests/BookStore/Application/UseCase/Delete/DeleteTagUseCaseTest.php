<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\Delete;

use App\BookStore\Application\UseCase\Delete\DeleteTag;
use App\BookStore\Application\UseCase\Delete\DeleteTagUseCase;
use App\BookStore\Domain\Model\TagId;
use App\BookStore\Domain\Repository\TagRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class DeleteTagUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $tagId = new TagId();
        $repository = $this->prophesize(TagRepository::class);
        $repository->delete($tagId)
            ->shouldBeCalledOnce()
        ;

        $command = new DeleteTag($tagId);
        $useCase = new DeleteTagUseCase($repository->reveal());

        $useCase($command);
    }
}
