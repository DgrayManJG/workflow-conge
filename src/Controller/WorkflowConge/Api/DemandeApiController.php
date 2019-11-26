<?php

namespace App\Controller\WorkflowConge\Api;

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

class DemandeApiController extends Controller
{

    /**
     * @Route("/Demande/observation", name="addObservation", methods={"POST"})
     *
     * @param Symfony\Component\HttpFoundation\Request $request
     *
     * @return Response
     */
    public function addObservation(Request $request)
    {
        $Demande = $this->getDoctrine()
                ->getRepository(Demande::class)
                    ->find($request->request->get('idDemande'));

        if (!empty($request->request->get('observation_demande'))) {

            $Demande->setObservation($request->request->get('observation_demande'));

            # Insertion en BDD
            $em = $this->getDoctrine()->getManager();

            $em->persist($Demande);
            $em->flush();

            # Notification
            $this->addFlash('notice', 'L\'observation a bien été prise en compte');

            return $this->redirectToRoute('demande_approval');
        }

        # Notification
        $this->addFlash('error', 'Veuillez remplir le champ d\'observation');

        return $this->redirectToRoute('demande_approval');
    }

}
