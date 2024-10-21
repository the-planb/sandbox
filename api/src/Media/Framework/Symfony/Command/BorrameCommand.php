<?php

declare(strict_types=1);

namespace App\Media\Framework\Symfony\Command;

use App\Media\Application\UseCase\Search\SearchMovie;
use App\Media\Domain\Input\MovieInput;
use League\Tactician\CommandBus;
use PlanB\Domain\Criteria\Criteria;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand(
    name: 'app:borrame',
    description: 'Add a short description for your command',
)]
class BorrameCommand extends Command
{
    private SerializerInterface $serializer;
    private CommandBus $commandBus;

    public function __construct(SerializerInterface $denormalizer, CommandBus $commandBus)
    {
        $this->serializer = $denormalizer;
        $this->commandBus = $commandBus;
        parent::__construct();
    }

    protected function configure(): void
    {
        //        $this->addOption('project', 'p', InputOption::VALUE_OPTIONAL, 'Path to project definition', 'default');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $command = new SearchMovie(Criteria::fromValues([
            'itemsPerPage' => 1,
        ]));

        $data = $this->commandBus->handle($command);

        $command = $this->serializer->serialize($data, 'jsonld', [
            'enable_max_depth' => true,
            'groups' => ['read'],
        ]);

        echo $command;

        //        dump(json_encode(json_decode($command), JSON_PRETTY_PRINT ) );
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
