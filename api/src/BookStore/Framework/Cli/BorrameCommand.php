<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Cli;

use App\BookStore\Domain\Repository\AuthorRepository;
use App\BookStore\Framework\Doctrine\Repository\AuthorDoctrineRepository;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Domain\Criteria\Filter;
use PlanB\Domain\Criteria\FilterList;
use PlanB\Domain\Criteria\Operator;
use PlanB\Domain\Criteria\Order;
use PlanB\Domain\Criteria\OrderDir;
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
    private AuthorRepository $repository;

    public function __construct(AuthorDoctrineRepository $repository)
    {
        parent::__construct(null);
        $this->repository = $repository;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'the name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $value = $input->getArgument('name');

        $criteria = new Criteria(
            FilterList::collect([
                new Filter('name', Operator::EQUALS, $value),
            ]),
            new Order('id', OrderDir::ASC),
            1,
            10
        );
        $lista = $this->repository->match($criteria);

        dump($lista);

        return Command::SUCCESS;
    }
}
