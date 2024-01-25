<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Application\UseCase\Create;

use App\BookStore\Application\UseCase\Create\CreateAuthor;
use App\BookStore\Application\UseCase\Create\CreateAuthorUseCase;
use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Repository\AuthorRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class CreateAuthorUseCaseTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_execute_the_command_properly()
    {
        $repository = $this->prophesize(AuthorRepository::class);

        $repository->save(Argument::type(Author::class))
            ->shouldBeCalledOnce()
        ;

        $command = new CreateAuthor($this->doubleAuthorInput());
        $useCase = new CreateAuthorUseCase($repository->reveal());

        $useCase($command);
    }
}
