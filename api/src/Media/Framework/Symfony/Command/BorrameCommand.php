<?php

declare(strict_types=1);

namespace App\Media\Framework\Symfony\Command;

use App\Media\Domain\Input\MovieInput;
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
        $code = <<<'eof'
            {
                "title": "pelicula",
                "releaseYear": 1960,
                "director": {
                    "@id": "/api/media/directors/019127a6-fd4f-85c1-24f7-6ece382101d9",
                    "@type": "Director",
                    "id": "019127a6-fd4f-85c1-24f7-6ece382101d9",
                    "name": "asdad",
                    "movies": [
                        {
                            "@id": "/api/media/movies/019127ab-7992-1f56-5045-cc9856018640",
                            "@type": "Movie",
                            "id": "019127ab-7992-1f56-5045-cc9856018640",
                            "title": "asdfasfasfd",
                            "releaseYear": 1967,
                            "director": "/api/media/directors/019127a6-fd4f-85c1-24f7-6ece382101d9",
                            "reviews": [
                                {
                                    "@id": "/api/media/reviews/019127ab-7992-1f56-5045-cc9856018641",
                                    "@type": "Review",
                                    "id": "019127ab-7992-1f56-5045-cc9856018641",
                                    "name": "sdfasfasdfsaf",
                                    "movie": "/api/media/movies/019127ab-7992-1f56-5045-cc9856018640"
                                },
                                {
                                    "@id": "/api/media/reviews/019127ab-7992-1f56-5045-cc9856018642",
                                    "@type": "Review",
                                    "id": "019127ab-7992-1f56-5045-cc9856018642",
                                    "name": "asdafafasfafasdfaf",
                                    "movie": "/api/media/movies/019127ab-7992-1f56-5045-cc9856018640"
                                }
                            ],
                            "genres": [
                                {
                                    "@id": "/api/media/genres/019127a7-25c7-6f35-fc14-e4d53412d9dc",
                                    "@type": "Genre",
                                    "id": "019127a7-25c7-6f35-fc14-e4d53412d9dc",
                                    "name": "terror",
                                    "movies": []
                                }
                            ],
                            "overview": "asdadad asda dsadadsasdsa"
                        },
                        "/api/media/movies/019127a8-4799-a331-3c3a-fe74688645e2"
                    ]
                },
                "reviews": [
                    "/api/media/reviews/019127a8-4799-a331-3c3a-fe74688645e3"
                ],
                "genres": [
                    {
                        "@id": "/api/media/genres/019127a7-25c7-6f35-fc14-e4d53412d9dc",
                        "@type": "Genre",
                        "id": "019127a7-25c7-6f35-fc14-e4d53412d9dc",
                        "name": "terror",
                        "movies": []
                    }
                ],
                "overview": "esto es el resumen de una pelicula que me lñalkadsaśd"
            }
            eof;

        $data = json_decode($code, true);

        $aaa = $this->denormalizer->denormalize($data, MovieInput::class, null, [
            'enable_max_depth' => true,
            'groups' => ['post'],
        ]);

        dump($aaa);

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
