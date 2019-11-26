<?php

namespace App\Controller\WorkflowConge;

use App\Demande\DemandeRequest;
use App\Demande\DemandeRequestHandler;
use App\Demande\DemandeRequestUpdateHandler;
use App\Demande\DemandeType;
use App\Demande\DemandeBisType;
use App\Demande\DemandeWorkflowHandler;
use App\Controller\HelperTrait;
use App\Entity\Demande;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Component\Workflow\Registry;

class DemandeController extends Controller
{

    use HelperTrait;

    /**
     * Démonstration de l'ajout d'un Demande
     * avec Doctrine. (Data Mapper)
     * @Route("/demande", name="demande")
     */
    public function index()
    {

        return new Response('index');
    }

    /**
     * Formulaire pour créer un Demande
     * @Route({
     *     "fr": "/creer-un-demande",
     *     "en": "/new-demande"
     * }, name="demande_add")
     * @Security("has_role('ROLE_AUTHOR')")
     * @param Request $request
     * @param DemandeRequestHandler $DemandeRequestHandler
     * @return Response
     */
    public function addDemande(Request $request, DemandeRequestHandler $DemandeRequestHandler)
    {
        # Création d'un nouvel Demande
        # $Demande = new Demande();
        $demande = new DemandeRequest($this->getUser());

        # Créer un Formulaire permettant l'ajout d'un Demande
        $form = $this->createForm(DemandeType::class, $demande)
            ->handleRequest($request);
            
        # Traitement des données POST
        # $form->handleRequest($request);

        # Vérification des données du Formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * Une fois le formulaire soumit et valide,
             * on passe nos données directement au service
             * qui se chargera du traitement.
             */
            $demande = $DemandeRequestHandler->handle($demande);

            # Flash Messages
            $this->addFlash('notice', 'Félicitation, votre demande à été finalisé et est en attente d\'envoi à votre supérieur hiérarchique !');

            # Redirection sur l'Demande qui vient d'être créé.
            return $this->redirectToRoute('index_demande', [
                'slug' => $demande->getSlug(),
                'id' => $demande->getId()
            ]);
        }

        # Affichage du Formulaire dans la vue
        return $this->render('demande/addDemande.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Editer / Modifier un demande
     * @Route("/editer-un-demande/{id<\d+>}", name="demande_edit")
     * @Security("has_role('ROLE_AUTHOR')")
     * @param Demande $demande
     * @param Request $request
     * @param Packages $packages
     * @param DemandeRequestUpdateHandler $updateHandler
     * @return Response
     * @internal param DemandeRequestHandler $DemandeRequestHandler
     * @internal param DemandeRequest $DemandeRequest
     */
    public function editDemande(Demande $Demande, Request $request, Packages $packages, DemandeRequestUpdateHandler $updateHandler)
    {
        
        # Récupération de notre DemandeRequest depuis Demande
        # $DemandeRequestHandler->prepareDemandeFromRequest($Demande);
        $ar = DemandeRequest::createFromDemande($Demande, $packages, $this->getParameter('Demandes_assets_directory'));

        # Création du Formulaire
        $options = [
            'image_url' => $ar->getImageUrl(),
            'slug' => $ar->getSlug()
        ];

        $form = $this->createForm(DemandeType::class, $ar, $options)
            ->handleRequest($request);

        # Quand le formulaire est soumis
        if ($form->isSubmitted() && $form->isValid()) {

            # On sauvegarde les données
            $Demande = $updateHandler->handle($ar, $Demande);

            # Flash Message
            $this->addFlash('notice', 'Modification Effectuée !');

            return $this->redirectToRoute('demande_edit', [
                'id' => $Demande->getId()
            ]);
        }

        # Affichage du Formulaire dans la vue
        return $this->render('demande/addDemande.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Afficher les Demandes publiés d'un Auteur
     * @Route({
     *     "fr": "/mes-demandes",
     *     "en": "/my-demandes"
     * }, name="demande_published")
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function publishedDemandes()
    {
        # Récupération de l'Auteur
        $author = $this->getUser();

        # Récupération des Demandes
        $demandes = $this->getDoctrine()
            ->getRepository(Demande::class)
            ->findAuthorDemandeByStatus($author->getId(), 'published');

        # Affichage dans la vue
        return $this->render('demande/demandes.html.twig', [
            'demandes' => $demandes,
            'title' => 'Mes demandes acceptées'
        ]);
    }

    /**
     * Afficher les Demandes en attente de soumission
     * @Route({
     *     "fr": "/mes-demandes/en-attente",
     *     "en": "/my-demandes/pending"
     * }, name="demande_pending")
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function pendingDemandes()
    {
        # Récupération de l'Auteur
        $author = $this->getUser();

        # Récupération des Demandes
        $demandes = $this->getDoctrine()
            ->getRepository(Demande::class)
            ->findAuthorDemandeByStatus($author->getId(), 'review');

        # Affichage dans la vue
        return $this->render('demande/demandes.html.twig', [
            'demandes' => $demandes,
            'title' => 'Mes demandes de congé en attente d\'envoi'
        ]);
    }

    /**
     * Afficher les Demandes en attente de validation
     * @Route({
     *     "fr": "/les-demandes/en-attente-de-validation",
     *     "en": "/demandes/pending-approval"
     * }, name="demande_approval")
     * @Security("has_role('ROLE_EDITOR')")
     */
    public function approvalDemandes()
    {
        # Récupération des Demandes
        $demandes = $this->getDoctrine()
            ->getRepository(Demande::class)
            ->findDemandesByStatus('editor');

        # Affichage dans la vue
        return $this->render('demande/demandes.html.twig', [
            'demandes' => $demandes,
            'title' => 'Liste des demandes à validé'
        ]);
    }

    /**
     * Permet de changer le status d'un Demande
     * @Route("workflow/{status}/{id}", name="demande_workflow")
     * @Security("has_role('ROLE_AUTHOR')")
     * @param $status
     * @param Demande $demande
     * @param DemandeWorkflowHandler $awh
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @internal param Registry $workflows
     */
    public function workflow($status,
                            Demande $Demande,
                            DemandeWorkflowHandler $awh,
                            Request $request)
    {
        # Traitement du Workflow

        try {
            $awh->handle($Demande, $status);

            # Notification
            $this->addFlash('notice',
                'La demande à bien été transmis. Merci.');

        } catch (LogicException $e) {

            # Notification
            $this->addFlash('error',
                'Changement de statut impossible.');

        }

        # Récupération du Redirect
        $redirect = $request->get('redirect') ?? 'index';

        # On redirige l'utilisateur sur la bonne page
        return $this->redirectToRoute($redirect);

    }

}
