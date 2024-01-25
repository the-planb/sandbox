<?php

namespace PlanB\Framework\Testing;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Domain\Model\Entity;
use PlanB\Domain\Model\EntityId;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

final class ManagerRegistryDouble extends Double
{

    private ?string $entityClass = null;
    private ObjectProphecy|EntityManagerInterface $entityManager;
    private ObjectProphecy|Query $query;


    protected function classNameOrInterface(): string
    {
        return ManagerRegistry::class;
    }

    protected function configure(): void
    {
        $this->query = $this->mock(Query::class);
        $this->entityManager = $this->mock(EntityManagerInterface::class);
    }

    public function withEntityClass(string $entityClass): static
    {
        $this->entityClass = $entityClass;
        return $this;
    }

    public function reveal(): object
    {
        $classMetadata = $this->mock(ClassMetadata::class);
        $classMetadata->name = $this->entityClass;

        $queryBuilder = $this->mock(QueryBuilder::class);
        $queryBuilder
            ->select(Argument::cetera())
            ->willReturn($queryBuilder);
        $queryBuilder
            ->from(Argument::cetera())
            ->willReturn($queryBuilder);

        $queryBuilder
            ->setFirstResult(Argument::cetera())
            ->willReturn($this->query);

        $queryBuilder
            ->setMaxResults(Argument::cetera())
            ->willReturn($this->query);

        $queryBuilder
            ->getQuery(Argument::cetera())
            ->willReturn($this->query);

        $this->entityManager->getClassMetadata(Argument::any())
            ->willReturn($classMetadata->reveal());

        $this->entityManager->createQueryBuilder(Argument::any())
            ->willReturn($queryBuilder->reveal());

        $managerRegistry = $this->mock(ManagerRegistry::class);
        $managerRegistry->getManagerForClass($this->entityClass ?? Argument::any())
            ->willReturn($this->entityManager->reveal());

        return $managerRegistry->reveal();
    }


    public function withReference(EntityId $id, Entity $entity): static
    {
        $this->entityManager->getReference(Argument::any(), $id)
            ->willReturn($entity);

        $this->entityManager->find(Argument::any(), $id, Argument::cetera())
            ->willReturn($entity);

        return $this;
    }


    public function persists(Entity $entity): static
    {
        $this->entityManager
            ->persist($entity)
            ->shouldBeCalled();
        return $this;
    }

    public function remove(Entity $entity): static
    {
        $this->withReference($entity->getId(), $entity);
        $this->entityManager
            ->remove($entity)
            ->shouldBeCalled();
        return $this;
    }


    public function totalItems(int $total): static
    {
        $this->query
            ->getSingleScalarResult()
            ->willReturn($total);

        return $this;
    }

    public function execute(array $data)
    {
        $this->query
            ->execute(Argument::cetera())
            ->willReturn($data);

        return $this;
    }

    protected function double(): ManagerRegistry
    {
        return $this->double;
    }
}
