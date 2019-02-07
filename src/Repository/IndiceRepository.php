<?php

namespace App\Repository;

use App\Entity\Indice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Indice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Indice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Indice[]    findAll()
 * @method Indice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Indice::class);
    }

    // /**
    //  * @return Indice[] Returns an array of Indice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Indice
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
