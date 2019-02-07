<?php

namespace App\Repository;

use App\Entity\PointTrouve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PointTrouve|null find($id, $lockMode = null, $lockVersion = null)
 * @method PointTrouve|null findOneBy(array $criteria, array $orderBy = null)
 * @method PointTrouve[]    findAll()
 * @method PointTrouve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointTrouveRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PointTrouve::class);
    }

    // /**
    //  * @return PointTrouve[] Returns an array of PointTrouve objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PointTrouve
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
