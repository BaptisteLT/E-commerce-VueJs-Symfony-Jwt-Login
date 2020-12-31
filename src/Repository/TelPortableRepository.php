<?php

namespace App\Repository;

use App\Entity\TelPortable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TelPortable|null find($id, $lockMode = null, $lockVersion = null)
 * @method TelPortable|null findOneBy(array $criteria, array $orderBy = null)
 * @method TelPortable[]    findAll()
 * @method TelPortable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelPortableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TelPortable::class);
    }

    // /**
    //  * @return TelPortable[] Returns an array of TelPortable objects
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
    public function findOneBySomeField($value): ?TelPortable
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
