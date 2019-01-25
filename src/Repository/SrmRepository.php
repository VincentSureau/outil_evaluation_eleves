<?php

namespace App\Repository;

use App\Entity\Srm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Srm|null find($id, $lockMode = null, $lockVersion = null)
 * @method Srm|null findOneBy(array $criteria, array $orderBy = null)
 * @method Srm[]    findAll()
 * @method Srm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SrmRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Srm::class);
    }

    // /**
    //  * @return Srm[] Returns an array of Srm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Srm
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
