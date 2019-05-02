<?php

namespace App\Repository;

use App\Entity\MELECCompetence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MELECCompetence|null find($id, $lockMode = null, $lockVersion = null)
 * @method MELECCompetence|null findOneBy(array $criteria, array $orderBy = null)
 * @method MELECCompetence[]    findAll()
 * @method MELECCompetence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MELECCompetenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MELECCompetence::class);
    }

    // /**
    //  * @return MELECCompetence[] Returns an array of MELECCompetence objects
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
    public function findOneBySomeField($value): ?MELECCompetence
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
