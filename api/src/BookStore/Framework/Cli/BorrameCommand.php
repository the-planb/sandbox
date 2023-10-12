<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Cli;

use App\BookStore\Domain\Repository\BookRepository;
use PlanB\Domain\Criteria\Criteria;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(
    name: 'app:borrame',
    description: 'Add a short description for your command',
)]
class BorrameCommand extends Command
{
    private ValidatorInterface $validator;
    private BookRepository $repository;

    public function __construct(BookRepository $repository)
    {
        parent::__construct(null);
        $this->repository = $repository;
    }

    protected function configure(): void
    {
        //        $this
        //            ->addArgument('name', InputArgument::REQUIRED, 'the name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $criteria = new Criteria();
        $lista = $this->repository->match($criteria);

        $io->text("Hemos encontrado: {$lista->count()} libros");

        return Command::SUCCESS;
    }
}
