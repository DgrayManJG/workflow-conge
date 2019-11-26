<?php

namespace App\Demande\Source;


use App\Entity\Demande;
use Doctrine\Common\Persistence\ObjectManager;

class DoctrineSource extends DemandeAbstractSource
{

    private $repository;
    private $entity = Demande::class;

    /**
     * DoctrineSource constructor.
     * @param $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->repository = $manager->getRepository($this->entity);
    }

    /**
     * Permet de retourner un Demande sur la
     * base de son identifiant unique.
     * @param $id
     * @return Demande|null
     */
    public function find($id): ?Demande
    {
        return $this->repository->find($id);
    }

    /**
     * Retourne la liste de tous les Demandes
     * @return iterable|null
     */
    public function findAll(): ?iterable
    {
        return $this->repository->findAll();
    }

    /**
     * Retourne les 5 derniers Demandes depuis
     * l'ensemble de nos sources...
     * @return iterable|null
     */
    public function findLastFiveDemandes(): ?iterable
    {
        return $this->repository->findLastFiveDemandes();
    }

    /**
     * Retourne le nombre d'éléments de chaque source.
     * @return int
     */
    public function count(): int
    {
        return $this->repository->findTotalDemandes();
    }

    /**
     * Permet de convertir un tableau en Demande.
     * @param iterable $Demande Un Demande sous forme de tableau
     * @return Demande|null
     */
    protected function createFromArray(iterable $Demande): ?Demande
    {
        return null;
    }
}