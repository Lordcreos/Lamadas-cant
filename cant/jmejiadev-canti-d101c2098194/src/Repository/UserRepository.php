<?php
/**
 * Created by PhpStorm.
 * User: jmejia
 * Date: 2019-03-12
 * Time: 13:36
 */

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getUserByCount($camId): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
             Select u.id, count(r.id) as min 
             from fos_user u
             left join ct_registros r on u.id = r.useraxis_id and r.reg_estado = "ASIGNADO"
             where u.roles like "%VENTAS%"
             and u.ctcampanas_id = '.$camId.'
             group by u.id Order By min  
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllUser(): array
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT u
            FROM App:User u
            ORDER BY u.usuApellidos');
//    $consulta->setParameter('roles', '%"' . $role . '"%');
        return $consulta->getArrayResult();
    }

    public function getEditUser($id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT u.username, u.email FROM fos_user u
            WHERE u.id != '.$id.'
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getUserByRol($rol): array
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT u
            FROM App:User u
            WHERE u.roles LIKE :roles
            ORDER BY u.usuApellidos');
        $consulta->setParameter('roles', '%"' . $rol . '"%');
        return $consulta->getArrayResult();
    }

}