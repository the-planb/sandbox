<?php
declare(strict_types=1);

namespace PlanB\Framework\Testing\Test;

use Doctrine\ORM\EntityManagerInterface;
use League\Tactician\CommandBus;
use PlanB\Framework\Testing\DataFactory\DataFactoryInterface;
use Prophecy\PhpUnit\ProphecyTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

abstract class FunctionalTest extends KernelTestCase
{
    use ProphecyTrait;

    private DenormalizerInterface $denormalizer;
    private CommandBus $commandBus;
    private EntityManagerInterface $entityManager;
    private DataFactoryInterface $dataFactory;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = self::getContainer();
        $this->denormalizer = $container->get(DenormalizerInterface::class);
        $this->commandBus = $container->get(CommandBus::class);
        $this->entityManager = $container->get(EntityManagerInterface::class);
//        $this->dataFactory = $this->createDataFactory();
        $this->dataFactory = $container->get(DataFactoryInterface::class);
    }

    protected function denormalize(array $input, string $type, ?string $format = null, array $context = null): mixed
    {
        $context = $context ?? [
            'groups' => [
                'write'
            ]
        ];

        return $this->denormalizer->denormalize($input, $type, $format, $context);
    }

    protected function totalItems(string $entityClass, array $criteria = []): int
    {
        return $this->entityManager->getRepository($entityClass)
            ->count($criteria);
    }

    protected function handle(mixed $command): mixed
    {
        return $this->commandBus->handle($command);
    }

    protected function loadData(string $classOrInterface, string $mode, array $overwrite = []): array
    {
        return [
            ...$this->dataFactory->loadData($classOrInterface, $mode),
            ...$overwrite
        ];
    }

}
