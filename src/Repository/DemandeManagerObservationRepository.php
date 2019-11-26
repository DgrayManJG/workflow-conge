<?php

namespace App\Repository;

use App\Entity\DemandeManagerObservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DemandeManagerObservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeManagerObservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeManagerObservation[]    findAll()
 * @method DemandeManagerObservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeManagerObservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeManagerObservation::class);
    }

    // /**
    //  * @return DemandeManagerObservation[] Returns an array of DemandeManagerObservation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DemandeManagerObservation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
