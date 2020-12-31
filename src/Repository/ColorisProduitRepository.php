<?php

namespace App\Repository;

use App\Entity\ColorisProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ColorisProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method ColorisProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method ColorisProduit[]    findAll()
 * @method ColorisProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColorisProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ColorisProduit::class);
    }

    // /**
    //  * @return ColorisProduit[] Returns an array of ColorisProduit objects
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
    public function findOneBySomeField($value): ?ColorisProduit
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
