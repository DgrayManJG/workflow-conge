<?php

namespace App\Demande;


use App\Entity\Demande;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Component\Workflow\Registry;

class DemandeWorkflowHandler
{

    private $workflows, $manager;

    public function __construct(Registry $workflows, ObjectManager $manager)
    {
        $this->workflows = $workflows;
        $this->manager = $manager;
    }

    public function handle(Demande $Demande, string $status): void
    {
        # Récupération du Workflow
        $workflow = $this->workflows->get($Demande);

        # permet de vider le champ observation quand on passe de to_approval à editor_approuved
        $Demande = $this->emptyObservation($workflow, $Demande);

        # Récupération de Doctrine
        $em = $this->manager;

        # Changement du Workflow
        $workflow->apply($Demande, $status);

        # Insertion en BDD
        $em->flush();

        # Publication de l'Demande si possible
        if ($workflow->can($Demande, 'to_be_published')) {
            $workflow->apply($Demande, 'to_be_published');
            $em->flush();
        }
    }

    /**
     * permet de vider le champ observation quand on passe de to_approval à editor_approuved
     */
    public function emptyObservation($workflow, $Demande)
    {
        if ($workflow->can($Demande, 'editor_approuved')) {
            $Demande->setObservation('');
        }

        return $Demande;
    }
}