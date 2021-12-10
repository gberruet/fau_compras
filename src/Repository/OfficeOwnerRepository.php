<?php

namespace App\Repository;

use App\Entity\OfficeOwner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OfficeOwner|null find($id, $lockMode = null, $lockVersion = null)
 * @method OfficeOwner|null findOneBy(array $criteria, array $orderBy = null)
 * @method OfficeOwner[]    findAll()
 * @method OfficeOwner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfficeOwnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OfficeOwner::class);
    }

    // /**
    //  * @return OfficeOwner[] Returns an array of OfficeOwner objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OfficeOwner
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
