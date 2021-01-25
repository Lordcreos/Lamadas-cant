<?php

namespace App\Repository;

use App\Entity\CtCampanas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CtCampanas|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtCampanas|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtCampanas[]    findAll()
 * @method CtCampanas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtCampanasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CtCampanas::class);
    }

    public function getAllCampanas(): array
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT c
            FROM App:CtCampanas c
            ORDER BY c.camNombre');
        return $consulta->getArrayResult();
    }

    public function getEditCampanas($id): array
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT c
            FROM App:CtCampanas c
            WHERE c.id != :id
            ORDER BY c.camNombre');
    $consulta->setParameter('id', $id);
        return $consulta->getArrayResult();
    }

    // /**
    //  * @return CtCampanas[] Returns an array of CtCampanas objects
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
    public function findOneBySomeField($value): ?CtCampanas
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
