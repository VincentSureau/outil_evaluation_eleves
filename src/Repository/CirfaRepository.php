<?php

namespace App\Repository;

use App\Entity\Cirfa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cirfa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cirfa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cirfa[]    findAll()
 * @method Cirfa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CirfaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cirfa::class);
    }

    // /**
    //  * @return Cirfa[] Returns an array of Cirfa objects
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
    public function findOneBySomeField($value): ?Cirfa
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
