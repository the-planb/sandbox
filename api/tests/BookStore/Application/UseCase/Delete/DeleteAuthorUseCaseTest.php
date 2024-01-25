<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\Delete;

use App\BookStore\Application\UseCase\Delete\DeleteAuthor;
use App\BookStore\Application\UseCase\Delete\DeleteAuthorUseCase;
use App\BookStore\Domain\Model\AuthorId;
use App\BookStore\Domain\Repository\AuthorRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class DeleteAuthorUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $authorId = new AuthorId();
        $repository = $this->prophesize(AuthorRepository::class);
        $repository->delete($authorId)
            ->shouldBeCalledOnce()
        ;

        $command = new DeleteAuthor($authorId);
        $useCase = new DeleteAuthorUseCase($repository->reveal());

        $useCase($command);
    }
}
