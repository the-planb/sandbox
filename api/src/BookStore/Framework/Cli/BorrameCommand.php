<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Cli;

use App\BookStore\Application\Input\BookInput;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand(
    name: 'app:borrame',
    description: 'Add a short description for your command',
)]
class BorrameCommand extends Command
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        parent::__construct(null);
        $this->serializer = $serializer;
    }

    protected function configure(): void
    {
        //        $this
        //            ->addArgument('name', InputArgument::REQUIRED, 'the name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('show_product')
            ->toArray()
        ;

        $data = $this->serializer->denormalize([
            'title' => 'the title',
        ], BookInput::class, null, [
            'groups' => ['read', 'write'],
        ]);
        dump($data, $context);

        return Command::SUCCESS;
    }
}
