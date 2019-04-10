<?php

namespace App\Repository;

use App\Entity\SNCompetence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SNCompetence|null find($id, $lockMode = null, $lockVersion = null)
 * @method SNCompetence|null findOneBy(array $criteria, array $orderBy = null)
 * @method SNCompetence[]    findAll()
 * @method SNCompetence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SNCompetenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SNCompetence::class);
    }

    // /**
    //  * @return SNCompetence[] Returns an array of SNCompetence objects
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
    public function findOneBySomeField($value): ?SNCompetence
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
