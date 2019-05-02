<?php

namespace App\Repository;

use App\Entity\MELECSubCompetence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MELECSubCompetence|null find($id, $lockMode = null, $lockVersion = null)
 * @method MELECSubCompetence|null findOneBy(array $criteria, array $orderBy = null)
 * @method MELECSubCompetence[]    findAll()
 * @method MELECSubCompetence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MELECSubCompetenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MELECSubCompetence::class);
    }

    // /**
    //  * @return MELECSubCompetence[] Returns an array of MELECSubCompetence objects
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
    public function findOneBySomeField($value): ?MELECSubCompetence
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
