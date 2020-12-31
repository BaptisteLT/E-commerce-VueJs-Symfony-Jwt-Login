<?php

namespace App\Repository;

use App\Entity\TelPortablePrefix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TelPortablePrefix|null find($id, $lockMode = null, $lockVersion = null)
 * @method TelPortablePrefix|null findOneBy(array $criteria, array $orderBy = null)
 * @method TelPortablePrefix[]    findAll()
 * @method TelPortablePrefix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelPortablePrefixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TelPortablePrefix::class);
    }

    // /**
    //  * @return TelPortablePrefix[] Returns an array of TelPortablePrefix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TelPortablePrefix
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
