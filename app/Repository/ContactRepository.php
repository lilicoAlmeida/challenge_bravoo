<?php

namespace App\Repository;

use Doctrine\ORM\EntityManager;
use Src\Entity\Contact;

class ContactRepository
{
    private EntityManager $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Contact::class);
    }

    public function find(int $id): ?Contact
    {
        return $this->repository->find($id);
    }

    public function save(Contact $contact): void
    {
        $this->em->persist($contact);
        $this->em->flush();
    }

    public function remove(Contact $contact): void
    {
        $this->em->remove($contact);
        $this->em->flush();
    }

    public function findPaginated(int $page, int $limit): array
    {
        $offset = ($page - 1) * $limit;

        return $this->em->createQueryBuilder()
            ->select('c')
            ->from(Contact::class, 'c')
            ->join('c.person', 'p')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function countAll(): int
    {
        return (int) $this->em->createQueryBuilder()
            ->select('COUNT(c.id)')
            ->from(Contact::class, 'c')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchByPersonName(string $name): array
    {
        $qb = $this->em->createQueryBuilder();

        return $qb->select('c')
            ->from(Contact::class, 'c')
            ->join('c.person', 'p')
            ->where($qb->expr()->like('LOWER(p.name)', ':name'))
            ->setParameter('name', '%' . strtolower($name) . '%')
            ->getQuery()
            ->getResult();
    }
}
