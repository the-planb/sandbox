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

final class ManagerRegistryDouble extends TestDouble
{

    private ?string $entityClass = null;
    private ObjectProphecy $entityManager;
    private ObjectProphecy $query;

    public function __construct(callable $callback)
    {
        parent::__construct($callback, ManagerRegistry::class);
    }

    protected function initialize(): void
    {
        $this->query = $this->mock(Query::class);
        $this->entityManager = $this->mock(EntityManagerInterface::class);
    }

    public function withEntityClass(string $entityClass): self
    {
        $this->entityClass = $entityClass;
        return $this;
    }

    protected function configure(): void
    {
        $classMetadata = $this->stub(ClassMetadata::class);
        $classMetadata->name = $this->entityClass;

        $this->query->execute(Argument::cetera())->willReturn([]);

        $queryBuilder = $this->stub(QueryBuilder::class, fn($self) => [
            'select' => $self,
            'from' => $self,
            'setFirstResult' => $this->query,
            'setMaxResults' => $this->query,
            'getQuery' => $this->query,
        ]);

        $this->entityManager->getClassMetadata(Argument::any())
            ->willReturn($classMetadata);

        $this->entityManager->createQueryBuilder(Argument::any())
            ->willReturn($queryBuilder);

        $this->double()->getManagerForClass($this->entityClass ?? Argument::any())
            ->willReturn($this->entityManager->reveal());

    }

    public function withReference(EntityId $id, Entity $entity): self
    {
        $this->entityManager
            ->getReference(Argument::any(), $id)
            ->willReturn($entity);

        $this->entityManager
            ->find(Argument::any(), $id, Argument::cetera())
            ->willReturn($entity);

        return $this;
    }

    public function persists(Entity $entity): self
    {
        $this->entityManager
            ->persist($entity)
            ->shouldBeCalled();
        return $this;
    }

    public function remove(Entity $entity): self
    {
        $this->withReference($entity->getId(), $entity);
        $this->entityManager
            ->remove($entity)
            ->shouldBeCalled();
        return $this;
    }

    public function totalItems(int $total): self
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
}
