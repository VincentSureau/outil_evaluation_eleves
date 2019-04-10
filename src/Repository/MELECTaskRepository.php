<?php

namespace App\Repository;

use App\Entity\MELECTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MELECTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method MELECTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method MELECTask[]    findAll()
 * @method MELECTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MELECTaskRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MELECTask::class);
    }

    // /**
    //  * @return MELECTask[] Returns an array of MELECTask objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MELECTask
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
