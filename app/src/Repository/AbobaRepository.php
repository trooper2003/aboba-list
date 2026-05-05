<?php

namespace App\Repository;

use App\Entity\Aboba;
use App\Entity\MarriedStatusEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Aboba>
 */
class AbobaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aboba::class);
    }

    /**
     * @return Aboba[] Returns array of married Abobe objects
     */

    public function findByMarriedStatus(MarriedStatusEnum $marriedStatus): array
    {
        return $this->findBy(['marriedStatus' => $marriedStatus], ['createdAt' => 'DESC']);
    }

    public function findByMarriedStatusPaginated(?MarriedStatusEnum $marriedStatus, int $page, int $limit = 10): Paginator
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'DESC')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        if ($marriedStatus !== null)
        {
            $qb->andWhere('a.marriedStatus = :marriedStatus')
            ->setParameter('marriedStatus', $marriedStatus);
        }

        return new Paginator($qb);
    }

    public function findAllOrdered(): array
    {
        return $this->findBy([], ['createdAt' => 'DESC']);
    }

    //    /**
    //     * @return Aboba[] Returns an array of Aboba objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Aboba
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
