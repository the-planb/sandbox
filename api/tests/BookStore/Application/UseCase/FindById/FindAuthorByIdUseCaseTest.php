<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\FindById;

use App\BookStore\Application\UseCase\FindById\FindAuthorById;
use App\BookStore\Application\UseCase\FindById\FindAuthorByIdUseCase;
use App\BookStore\Domain\Model\AuthorId;
use App\BookStore\Domain\Repository\AuthorRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class FindAuthorByIdUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $authorId = new AuthorId();

        $repository = $this->prophesize(AuthorRepository::class);
        $repository->findById($authorId)
            ->shouldBeCalledOnce()
        ;

        $command = new FindAuthorById($authorId);
        $useCase = new FindAuthorByIdUseCase($repository->reveal());

        $useCase($command);
    }
}
