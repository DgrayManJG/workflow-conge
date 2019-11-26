<?php

namespace App\Demande\Source;


use App\Controller\HelperTrait;
use App\Entity\Demande;
use App\Entity\Category;
use App\Entity\User;
use App\Service\Demande\YamlProvider;
use Symfony\Component\Validator\Constraints\DateTime;
use Tightenco\Collect\Support\Collection;

class YamlSource extends DemandeAbstractSource
{

    use HelperTrait;

    private $Demandes;

    /**
     * YamlSource constructor.
     * @param $yamlProvider
     */
    public function __construct(YamlProvider $yamlProvider)
    {
        $this->Demandes = new Collection($yamlProvider->getDemandes());

        /*
         * Autre possibilitée :
         */
        # $this->Demandes = new Collection($yamlProvider->getDemandes());
        # foreach ($this->Demandes as &$Demande) {
        #    $Demande = $this->createFromArray($Demande);
        # }
    }

    /**
     * Permet de retourner un Demande sur la
     * base de son identifiant unique.
     * @param $id
     * @return Demande|null
     */
    public function find($id): ?Demande
    {
        $Demande = $this->Demandes->firstWhere('id', $id);
        return $Demande == null ? null : $this->createFromArray($Demande);
    }

    /**
     * Retourne la liste de tous les Demandes
     * @return iterable|null
     */
    public function findAll(): ?iterable
    {
        $Demandes = new Collection();

        foreach ($this->Demandes as $Demande) {
            $Demandes[] = $this->createFromArray($Demande);
        }

        return $Demandes;
    }

    /**
     * Retourne les 5 derniers Demandes depuis
     * l'ensemble de nos sources...
     * @return iterable|null
     */
    public function findLastFiveDemandes(): ?iterable
    {
        /* @var $Demandes Collection */
        $Demandes = $this->findAll();
        return $Demandes->sortBy('datecreation')->slice(-5);
    }

    /**
     * Retourne le nombre d'éléments de chaque source.
     * @return int
     */
    public function count(): int
    {
        return $this->Demandes->count();
    }

    /**
     * Permet de convertir un tableau en Demande.
     * @param iterable $Demande Un Demande sous forme de tableau
     * @return Demande|null
     */
    protected function createFromArray(iterable $Demande): ?Demande
    {
        $tmp = (object)$Demande;

        # Construire l'objet Category
        $category = new Category();
        $category->setId($tmp->categorie['id']);
        $category->setName($tmp->categorie['libelle']);
        $category->setSlug($this->slugify($tmp->categorie['libelle']));

        # Construire l'objet Auteur
        $user = new User();
        $user->setId($tmp->auteur['id']);
        $user->setFirstname($tmp->auteur['prenom']);
        $user->setLastname($tmp->auteur['nom']);

        $date = new \DateTime();

        # Construire l'objet Demande
        return new Demande(
            $tmp->id,
            $tmp->titre,
            $this->slugify($tmp->titre),
            $tmp->contenu,
            $tmp->featuredimage,
            $tmp->special,
            $tmp->spotlight,
            $date->setTimestamp($tmp->datecreation),
            $category,
            $user,
            'published',
            
        );

    }
}