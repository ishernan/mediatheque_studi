<?php

namespace App\Repository;

use App\Entity\ContenuQuantity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContenuQuantity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContenuQuantity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContenuQuantity[]    findAll()
 * @method ContenuQuantity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenuQuantityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContenuQuantity::class);
    }

    // /**
    //  * @return ContenuQuantity[] Returns an array of ContenuQuantity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContenuQuantity
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
