<?php

declare(strict_types=1);

namespace App\Media\Framework\Symfony\Command;

use App\Media\Application\UseCase\Create\CreateMovie;
use App\Media\Domain\Input\MovieInput;
use App\Media\Domain\Model\Genre;
use App\Media\Domain\Model\VO\GenreName;
use App\Media\Domain\Model\VO\Overview;
use App\Media\Domain\Model\VO\ReleaseYear;
use App\Media\Domain\Model\VO\ReviewContent;
use League\Tactician\CommandBus;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

#[AsCommand(
    name: 'app:borrame',
    description: 'Add a short description for your command',
)]
class BorrameCommand extends Command
{
    private DenormalizerInterface $denormalizer;
    private CommandBus $commandBus;

    public function __construct(DenormalizerInterface $denormalizer, CommandBus $commandBus)
    {
        $this->denormalizer = $denormalizer;
        $this->commandBus = $commandBus;
        parent::__construct();
    }

    protected function configure(): void
    {
        //        $this->addOption('project', 'p', InputOption::VALUE_OPTIONAL, 'Path to project definition', 'default');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $command = $this->denormalizer->denormalize('ssss', ReviewContent::class, null, [
            'enable_max_depth' => true,
            'groups' => ['write'],
        ]);

        dump($command);
        //        $this->commandBus->handle($command);

        //        $genre = new Genre(new GenreName('acción'));
        //
        //        $movie = $this->denormalizer->denormalize([
        //            'title' => 'hola',
        //            'releaseYear' => 1968,
        //            'genres' => [$genre, [
        //                'name' => 'terror'
        //            ]],
        //            'overview' => 'esta pelicula va de cosas, y pasan cosas'
        //        ], MovieInput::class);
        //
        //
        //        $command = new CreateMovie($movie);
        //        $this->commandBus->handle($command);

        return Command::SUCCESS;
    }
}
