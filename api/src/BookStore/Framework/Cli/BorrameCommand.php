<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Cli;

use App\Music\Application\Input\DiscoInput;
use App\Music\Application\UseCase\Create\CreateDisco;
use App\Music\Domain\Model\SongList;
use App\Music\Domain\Model\VO\DiscoName;
use App\Music\Domain\Repository\DiscoRepository;
use League\Tactician\CommandBus;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:borrame',
    description: 'Add a short description for your command',
)]
class BorrameCommand extends Command
{
    private CommandBus $commandBus;
    private DiscoRepository $repository;

    public function __construct(DiscoRepository $repository, CommandBus $commandBus)
    {
        parent::__construct(null);

        $this->commandBus = $commandBus;
        $this->repository = $repository;
    }

    protected function configure(): void
    {
        //        $this
        //            ->addArgument('name', InputArgument::REQUIRED, 'the name')
        //        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $input = new DiscoInput();
        $input->title = new DiscoName('Lo mejor de la musica disco');
        $input->songs = SongList::collect([
        ]);

        $command = new CreateDisco($input);

        $this->commandBus->handle($command);

        return Command::SUCCESS;
    }
}
