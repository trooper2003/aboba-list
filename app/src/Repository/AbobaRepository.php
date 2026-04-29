<?php

namespace App\Repository;

use App\Entity\Aboba;
use App\Entity\MarriedStatusEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
    public function findMarried()
    {
        return $this->createQueryBuilder('a')
            ->where('a.marriedStatus = :married')
            ->setParameter('married', MarriedStatusEnum::MARRIED)
            ->getQuery()
            ->getResult();
    }

    public function findNotMarried()
    {
        return $this->createQueryBuilder('a')
            ->where('a.marriedStatus = :married')
            ->setParameter('married', MarriedStatusEnum::NOT_MARRIED)
            ->getQuery()
            ->getResult();
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
