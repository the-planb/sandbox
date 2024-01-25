<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\Repository;

use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Model\TagId;
use App\BookStore\Domain\Model\TagList;
use App\BookStore\Domain\Repository\TagRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Doctrine\Criteria\DoctrineCriteriaConverter;

final class TagDoctrineRepository extends ServiceEntityRepository implements TagRepository
{
    private DoctrineCriteriaConverter $criteriaConverter;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
        $this->criteriaConverter = new DoctrineCriteriaConverter($this, [
        ]);
    }

    public function save(Tag $tag): Tag
    {
        $this->_em->persist($tag);

        return $tag;
    }

    public function delete(TagId $tagId): void
    {
        $tag = $this->_em->getReference(Tag::class, $tagId);
        $this->_em->remove($tag);
    }

    public function findById(TagId $tagId): ?Tag
    {
        $tag = $this->find($tagId);
        assert($tag instanceof Tag || is_null($tag));

        return $tag;
    }

    public function match(Criteria $criteria): TagList
    {
        $data = $this->criteriaConverter
            ->match($criteria)
            ->execute()
        ;

        return TagList::collect($data);
    }

    public function totalItems(Criteria $criteria = null): int
    {
        return $this->criteriaConverter
            ->count($criteria ?? Criteria::empty())
            ->getSingleScalarResult()
        ;
    }
}
