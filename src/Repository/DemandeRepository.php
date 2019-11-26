<?php

namespace App\Repository;

use App\Entity\Demande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Demande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Demande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Demande[]    findAll()
 * @method Demande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Demande::class);
    }

    /**
     * Compte le nombre d'Demandes dans la BDD
     * @return int|mixed
     */
    public function findTotalDemandes()
    {
        try {
            return $this->createQueryBuilder('a')
                ->select('COUNT(a)')
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }
    }

    /**
     * Récupérer tous les Demandes d'un Auteur par Statut.
     * @param int $idAuthor
     * @param string $status Status de l'Demande
     * @return \Doctrine\ORM\QueryBuilder
     * @internal param int $idauteur ID de l'Auteur
     */
    public function findAuthorDemandeByStatus(int $idAuthor, string $status)
    {
        return $this->createQueryBuilder('a')
            ->where('a.user = :author_id')
            ->setParameter('author_id', $idAuthor)
            ->andWhere('a.status LIKE :status')
            ->setParameter('status', "%$status%")
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupérer les Demandes par Statut
     * @param string $status
     * @return mixed
     */
    public function findDemandesByStatus(string $status)
    {
        return $this->createQueryBuilder('a')
            ->where('a.status LIKE :status')
            ->setParameter('status', "%$status%")
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Compter le nombre d'Demandes d'un Auteur par Statut
     * @param int $idAuthor
     * @param string $status
     * @return mixed
     */
    public function countAuthorDemandesByStatus(int $idAuthor, string $status)
    {
        try {
            return $this->createQueryBuilder('a')
                ->select('COUNT(a)')
                ->where('a.user = :author_id')
                ->setParameter('author_id', $idAuthor)
                ->andWhere('a.status LIKE :status')
                ->setParameter('status', "%$status%")
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }
    }

    /** Compter les Demandes par statut
     * @param string $status
     * @return int|mixed
     */
    public function countDemandesByStatus(string $status)
    {
        try {
            return $this->createQueryBuilder('a')
                ->select('COUNT(a)')
                ->where('a.status LIKE :status')
                ->setParameter('status', "%$status%")
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }
    }

}
