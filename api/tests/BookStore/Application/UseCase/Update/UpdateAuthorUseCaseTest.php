<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\Update;

use App\BookStore\Application\UseCase\Update\UpdateAuthor;
use App\BookStore\Application\UseCase\Update\UpdateAuthorUseCase;
use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\AuthorId;
use App\BookStore\Domain\Repository\AuthorRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class UpdateAuthorUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $authorId = new AuthorId();

        $repository = $this->prophesize(AuthorRepository::class);
        $repository->findById($authorId)
            ->willReturn($this->doubleAuthor())
        ;

        $repository->save(Argument::type(Author::class))
            ->shouldBeCalledOnce()
        ;

        $command = new UpdateAuthor($this->doubleAuthorInput(), $authorId);
        $useCase = new UpdateAuthorUseCase($repository->reveal());

        $useCase($command);
    }
}
