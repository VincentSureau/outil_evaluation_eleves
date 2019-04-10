<?php

namespace App\Repository;

use App\Entity\SNTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SNTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method SNTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method SNTask[]    findAll()
 * @method SNTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SNTaskRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SNTask::class);
    }

    // /**
    //  * @return SNTask[] Returns an array of SNTask objects
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
    public function findOneBySomeField($value): ?SNTask
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
