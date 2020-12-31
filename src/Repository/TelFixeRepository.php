<?php

namespace App\Repository;

use App\Entity\TelFixe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TelFixe|null find($id, $lockMode = null, $lockVersion = null)
 * @method TelFixe|null findOneBy(array $criteria, array $orderBy = null)
 * @method TelFixe[]    findAll()
 * @method TelFixe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelFixeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TelFixe::class);
    }

    // /**
    //  * @return TelFixe[] Returns an array of TelFixe objects
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
    public function findOneBySomeField($value): ?TelFixe
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
