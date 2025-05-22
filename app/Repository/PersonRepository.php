<?php

namespace App\Repository;

use Doctrine\ORM\EntityManager;
use Src\Entity\Person;

class PersonRepository
{
    private EntityManager $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Person::class);
    }

    public function find(int $id): ?Person
    {
        return $this->repository->find($id);
    }

    public function save(Person $person): void
    {
        $this->em->persist($person);
        $this->em->flush();
    }

    public function remove(Person $person): void
    {
        $this->em->remove($person);
        $this->em->flush();
    }

    public function searchByName(string $name): array
    {
        $qb = $this->em->createQueryBuilder();
        return $qb->select('p')
            ->from(Person::class, 'p')
            ->where($qb->expr()->like('LOWER(p.name)', ':name'))
            ->setParameter('name', '%' . strtolower($name) . '%')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findPaginated(int $page, int $limit): array
    {
        $offset = ($page - 1) * $limit;

        return $this->em->createQueryBuilder()
            ->select('p')
            ->from(Person::class, 'p')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function countAll(): int
    {
        return (int) $this->em->createQueryBuilder()
            ->select('COUNT(p.id)')
            ->from(Person::class, 'p')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findLimited(int $limit = 100): array
{
    return $this->em->createQueryBuilder()
        ->select('p')
        ->from(\Src\Entity\Person::class, 'p')
        ->orderBy('p.id', 'DESC')
        ->setMaxResults($limit)
        ->getQuery()
        ->getResult();
}

}
