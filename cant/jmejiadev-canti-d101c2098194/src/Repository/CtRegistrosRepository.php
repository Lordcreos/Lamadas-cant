<?php

namespace App\Repository;

use App\Entity\CtRegistros;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CtRegistros|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtRegistros|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtRegistros[]    findAll()
 * @method CtRegistros[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtRegistrosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CtRegistros::class);
    }

    public function getAllRegistros(): array
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT r.id, c.camNombre,  untg.username, r.regDocumento, r.regTelefono, r.regNombre, r.regProducto, 
            r.regTipGestion, r.regFecRegistro, t.tipLlaNombre, r.regEstado
            FROM App:CtRegistros r, App:User untg, App:CtCampanas c, App:CtTipLlamadas t
            WHERE r.userntg = untg.id
            AND r.ctcampanas = c.id
            AND r.cttipllamadas = t.id
            ORDER BY r.regFecRegistro, r.regEstado');
        return $consulta->getArrayResult();
    }

    public function getEditRegistros($id): array
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT r
            FROM App:CtRegistros r
            WHERE r.id != :id
            ORDER BY r.regFecRegistro');
        $consulta->setParameter('id', $id);
        return $consulta->getArrayResult();
    }

    public function getRegistrosByCampana($idCam, $estado): array
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT r.id, c.camNombre,  untg.username, r.regDocumento, r.regTelefono, r.regNombre, r.regProducto, 
            r.regTipGestion, r.regFecRegistro, t.tipLlaNombre
            FROM App:CtRegistros r, App:User untg, App:CtCampanas c, App:CtTipLlamadas t
            WHERE r.userntg = untg.id
            AND r.ctcampanas = c.id
            AND r.cttipllamadas = t.id
            AND r.ctcampanas = :idCam
            AND r.regEstado = :estado
            ORDER BY r.regFecRegistro');
        $consulta->setParameter('idCam', $idCam);
        $consulta->setParameter('estado', $estado);
        return $consulta->getArrayResult();
    }

    public function getRegistrosByEstados($estados): array
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT r.id, c.camNombre,  untg.username, r.regDocumento, r.regTelefono, r.regNombre, r.regProducto, 
            r.regTipGestion, r.regFecRegistro, t.tipLlaNombre, r.regTipGestion, r.regEstado, uaxis.username as useraxis, r.regFecGestion
            FROM App:CtRegistros r, App:User untg, App:CtCampanas c, App:CtTipLlamadas t, App:User uaxis 
            WHERE r.userntg = untg.id
            AND r.useraxis = uaxis.id
            AND r.ctcampanas = c.id
            AND r.cttipllamadas = t.id
            AND r.regEstado in (:estados)
            ORDER BY r.regFecRegistro');
        $consulta->setParameter('estados', $estados);
        return $consulta->getArrayResult();
    }

    public function getRegistrosByUseraxis($idUser, $estado): array
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT r.id, c.camNombre,  untg.username, r.regDocumento, r.regTelefono, r.regNombre, r.regProducto, 
            r.regTipGestion, r.regFecRegistro, t.tipLlaNombre, r.regTipGestion, r.regEstado, uaxis.username as useraxis, r.regFecGestion
            FROM App:CtRegistros r, App:User untg, App:CtCampanas c, App:CtTipLlamadas t, App:User uaxis 
            WHERE r.userntg = untg.id
            AND r.useraxis = uaxis.id
            AND r.ctcampanas = c.id
            AND r.cttipllamadas = t.id
            AND r.useraxis = :idUser
            AND r.regEstado = :estado
            ORDER BY r.regFecRegistro');
        $consulta->setParameter('idUser', $idUser);
        $consulta->setParameter('estado', $estado);
        return $consulta->getArrayResult();
    }

    public function getRegistrosByAgente($idUser): array
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT r.id, c.camNombre,  untg.username, r.regDocumento, r.regTelefono, r.regNombre, r.regProducto, 
            r.regTipGestion, r.regFecRegistro, t.tipLlaNombre, r.regEstado
            FROM App:CtRegistros r, App:User untg, App:CtCampanas c, App:CtTipLlamadas t
            WHERE r.userntg = untg.id
            AND r.ctcampanas = c.id
            AND r.cttipllamadas = t.id
            AND r.userntg = :idUser
            ORDER BY r.regFecRegistro');
        $consulta->setParameter('idUser', $idUser);
        return $consulta->getArrayResult();
    }

    public function getAsesor($camp): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
             Select u.id, u.username, u.email, u.ctcampanas_id, count(r.id) as min 
             from fos_user u
             left join ct_registros r on u.id = r.useraxis_id and r.reg_estado = "ASIGNADO"
             where u.roles like "%VENTAS%"
             and u.ctcampanas_id = '.$camp.'
             group by u.id Order By min  
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // /**
    //  * @return CtRegistros[] Returns an array of CtRegistros objects
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
    public function findOneBySomeField($value): ?CtRegistros
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
