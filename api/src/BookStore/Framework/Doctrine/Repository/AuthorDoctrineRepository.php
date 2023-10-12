<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\Repository;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Repository\AuthorRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class AuthorDoctrineRepository extends ServiceEntityRepository implements AuthorRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function save($author): Author
    {
        $this->_em->persist($author);

        return $author;
    }

    public function delete($authorId): void
    {
        $author = $this->_em->getReference(Author::class, $authorId);
        $this->_em->remove($author);
    }

    public function findById($authorId): ?Author
    {
        return $this->find($authorId);
    }
}
