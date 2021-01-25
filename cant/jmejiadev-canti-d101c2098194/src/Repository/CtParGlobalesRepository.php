<?php

namespace App\Repository;

use App\Entity\CtParGlobales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CtParGlobales|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtParGlobales|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtParGlobales[]    findAll()
 * @method CtParGlobales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtParGlobalesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CtParGlobales::class);
    }

    // /**
    //  * @return CtParGlobales[] Returns an array of CtParGlobales objects
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
    public function findOneBySomeField($value): ?CtParGlobales
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
