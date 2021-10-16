<?php

namespace App\Repository;

use App\Entity\Borrowed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Borrowed|null find($id, $lockMode = null, $lockVersion = null)
 * @method Borrowed|null findOneBy(array $criteria, array $orderBy = null)
 * @method Borrowed[]    findAll()
 * @method Borrowed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BorrowedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Borrowed::class);
    }

    // /**
    //  * @return Borrowed[] Returns an array of Borrowed objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Borrowed
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
