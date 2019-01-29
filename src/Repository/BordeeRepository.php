<?php

namespace App\Repository;

use App\Entity\Bordee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bordee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bordee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bordee[]    findAll()
 * @method Bordee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BordeeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bordee::class);
    }

    // /**
    //  * @return Bordee[] Returns an array of Bordee objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bordee
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
