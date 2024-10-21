<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Create;

use App\Media\Application\UseCase\Create\CreateGenre;
use App\Media\Application\UseCase\Create\CreateGenreUseCase;
use App\Media\Domain\Model\Genre;
use App\Media\Domain\Repository\GenreRepository;
use PlanB\Framework\Testing\Test\FunctionalTest;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;

/**
 * @internal
 */
final class CreateGenreUseCaseTest extends FunctionalTest
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(GenreRepository::class);
        $useCase = new CreateGenreUseCase($repository);

        $this->assertInstanceOf(CreateGenreUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_creates_a_new_genre_properly()
    {
        $itemsAfter = $this->totalItems(Genre::class);

        $this->dataLoader(Genre::class)
            ->create()


        $input = $this->loadData(Genre::class, 'create');
        $command = $this->denormalize($input, CreateGenre::class);

        $response = $this->handle($command);

        $itemsBefore = $this->totalItems(Genre::class);

        $this->assertInstanceOf(Genre::class, $response);
        $this->assertEquals($itemsBefore, $itemsAfter + 1);
    }
}
