<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 29/06/2018
 * Time: 10:42
 */

namespace App\Demande;


use App\Controller\HelperTrait;
use App\Entity\Demande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Component\Workflow\Registry;

class DemandeRequestHandler
{

    use HelperTrait;

    private $em, $assetsDirectory, $DemandeFactory, $packages, $workflows;

    /**
     * DemandeRequestHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param DemandeFactory $DemandeFactory
     * @param string $assetsDirectory
     * @param Registry $workflows
     * @param Packages $packages
     * @internal param Package $package
     * @internal param $em
     */
    public function __construct(EntityManagerInterface $entityManager,
                                DemandeFactory $DemandeFactory,
                                string $assetsDirectory,
                                Registry $workflows,
                                Packages $packages)
    {
        $this->em = $entityManager;
        $this->DemandeFactory = $DemandeFactory;
        $this->assetsDirectory = $assetsDirectory;
        $this->packages = $packages;
        $this->workflows = $workflows;
    }

    public function handle(DemandeRequest $request): ?Demande
    {
        # vérification qu'un document est upload ou non
        if (!empty($request->getFeaturedImage())) {
            # Traitement de l'upload de mon image
            /** @var UploadedFile $image */
            $image = $request->getFeaturedImage();

            # Nom du Fichier
            $fileName = rand(0, 100).$this->slugify($request->getTitle()) . '.'
                . $image->guessExtension();

            $image->move(
                $this->assetsDirectory,
                $fileName
            );

            # Mise à jour de l'image
            $request->setFeaturedImage($fileName);
        } 

        # Mise à jour du slug
        $request->setSlug($this->slugify($request->getTitle()));

        # Récupération du Workflow
        $workflow = $this->workflows->get($request);

        # Permet de voir les transitions possibles (Changement de Status)
        # dd($workflow->getEnabledTransitions($request));

        try {
            # Changement du Workflow
            $workflow->apply($request, 'to_review');

            # Appel à notre Factory
            $Demande = $this->DemandeFactory->createFromDemandeRequest($request);

            # Insertion en BDD
            $this->em->persist($Demande);
            $this->em->flush();

            return $Demande;

        } catch (LogicException $e) {

            # Transition non autorisé
            return null;

        }
    }

//    public function prepareDemandeFromRequest(Demande $Demande): DemandeRequest
//    {
//        return DemandeRequest::createFromDemande($Demande, $this->packages, $this->assetsDirectory);
//    }
}