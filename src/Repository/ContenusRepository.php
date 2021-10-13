<?php

namespace App\Repository;

use App\Classe\SearchItem;
use App\Entity\Contenus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contenus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contenus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contenus[]    findAll()
 * @method Contenus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contenus::class);
    }

    /**
    * fonction pour chercher selon les categories en BD en fonction d'utilisateur. Meme methode plus bas.
    * @return Contenus[]
    */
    public function rechercher (SearchItem $searchItem)
    {
        $query = $this
            ->createQueryBuilder('cn')
            ->select('c', 'cn')
            ->join('cn.category', 'c');

        if(!empty($searchItem->categories)){
            $query = $query
                ->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $searchItem->categories);
        }

        if(!empty($searchItem->string)){
            $query= $query
                ->andWhere('cn.titre LIKE :string')
                ->setParameter('string', "%{$searchItem->string}%" );
        }

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Contenus[] Returns an array of Contenus objects
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
    public function findOneBySomeField($value): ?Contenus
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
