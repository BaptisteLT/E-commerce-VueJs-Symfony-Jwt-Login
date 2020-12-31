<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }


    /**
    * @return Query
    */
    public function findAllProductsHomePageQuery(): Query
    {
        return $this->findAllProductsHomePage()
            ->getQuery();
    }

    /**
    * @return Produit[] Returns an array of Produit objects
    */
    public function findAllProductsHomePage(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->select('p.id','p.Nom','p.imageFilename','p.prix')
            ->orderBy('p.id', 'ASC');
    }
    

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
