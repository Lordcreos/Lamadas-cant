<?php

namespace App\Repository;

use App\Entity\CtTipLlamadas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CtTipLlamadas|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtTipLlamadas|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtTipLlamadas[]    findAll()
 * @method CtTipLlamadas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtTipLlamadasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CtTipLlamadas::class);
    }

    public function getAllTipLlamadas(): array
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT t
            FROM App:CtTipLlamadas t
            ORDER BY t.tipLlaNombre');
        return $consulta->getArrayResult();
    }

    public function getEditTipLlamadas($id): array
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT t
            FROM App:CtTipLlamadas t
            WHERE t.id != :id
            ORDER BY t.tipLlaNombre');
        $consulta->setParameter('id', $id);
        return $consulta->getArrayResult();
    }

    // /**
    //  * @return CtTipLlamadas[] Returns an array of CtTipLlamadas objects
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
    public function findOneBySomeField($value): ?CtTipLlamadas
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
