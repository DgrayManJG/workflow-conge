<?php

namespace App\Controller\WorkflowConge;


use App\Demande\DemandeCatalogue;
use App\Entity\Demande;
use App\Exception\DuplicateCatalogueDemandeException;
use App\Service\Demande\YamlProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * Page d'Accueil de notre Site Internet
     * @param YamlProvider $yamlProvider
     * @param DemandeCatalogue $catalogue
     * @return Response
     */
    public function index()
    {
        # Connexion au Repository
        $repository = $this->getDoctrine()
            ->getRepository(Demande::class);

        if ($this->getUser()) {
            $demandes = $repository->findAuthorDemandeByStatus($this->getUser()->getId(), "published");
        } else {
            $demandes = [];
        }
        
        return $this->render('index/index.html.twig', [
            'demandes' => $demandes
        ]);
    }

    /**
     * Affiche un Demande
     * @Route("/{slug}_{id<\d+>}.html",
     *     name="index_demande")
     * @param $id
     * @return Response
     * @internal param Demande $Demande
     */
    public function Demande($id)
    {   
        # Connexion au Repository
        $repository = $this->getDoctrine()
                ->getRepository(Demande::class);

        $demande = $repository->find($id); 

        # Transmission des données à la vue
        return $this->render('index/Demande.html.twig', [
            'demande' => $demande
        ]);
    }

    /**
     * Génération de la Sidebar
     * @param Demande|null $Demande
     * @return Response
     */
    public function sidebar(?Demande $Demande = null) {

        # Récupération du Répository
        //$repository = $this->getDoctrine()->getRepository(Demande::class);

        # Récupération des 5 derniers Demandes avec le composant YamlProvider dans un fichier Yaml situé dans le dossier Service
        # $Demandes = $catalogue->findLastFiveDemandes();

        # Récupération des 5 derniers Demandes
        //$Demandes = $repository->findLastFiveDemandes();

        # Récupérations des Demandes à la position "special" dans la BDD
        //$specials = $repository->findSpecialDemandes();

        # Rendu de la vue
        /*return $this->render('components/_sidebar.html.twig', [
            'Demandes' => $Demandes,
            'specials' => $specials,
            'Demande' => $Demande
        ]);*/

        return $this->render('components/_sidebar.html.twig');
    }
}
