<?php

namespace App\Demande\Source;


use App\Demande\DemandeCatalogue;
use App\Demande\DemandeRepositoryInterface;
use App\Entity\Demande;

abstract class DemandeAbstractSource implements DemandeRepositoryInterface
{
    protected $catalogue;

    /**
     * @param DemandeCatalogue $catalogue
     */
    public function setCatalogue(DemandeCatalogue $catalogue): void
    {
        $this->catalogue = $catalogue;
    }

    /**
     * Permet de convertir un tableau en Demande.
     * @param iterable $Demande Un Demande sous forme de tableau
     * @return Demande|null
     */
    abstract protected function createFromArray(iterable $Demande): ?Demande;

}
