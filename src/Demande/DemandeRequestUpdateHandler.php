<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 02/07/2018
 * Time: 18:05
 */

namespace App\Demande;


use App\Controller\HelperTrait;
use App\Entity\Demande;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DemandeRequestUpdateHandler
{

    use HelperTrait;

    private $em, $assetsDirectory;

    public function __construct(ObjectManager $manager,
                                string $assetsDirectory)
    {
        $this->em = $manager;
        $this->assetsDirectory = $assetsDirectory;
    }

    public function handle(DemandeRequest $DemandeRequest, Demande $Demande)
    {
        # Traitement de l'upload de mon image
        /** @var UploadedFile $image */
        $image = $DemandeRequest->getFeaturedImage();

        /*
         * Todo : Pensez a supprimer l'ancienne image sur le FTP.
         */
        if (null !== $image) {
            # Nom du Fichier
            $fileName = rand(0, 100).$this->slugify($DemandeRequest->getTitle()) . '.'
                . $image->guessExtension();

            $image->move(
                $this->assetsDirectory,
                $fileName
            );

            # Mise à jour de l'image
            $DemandeRequest->setFeaturedImage($fileName);
        } else {
            $DemandeRequest->setFeaturedImage($Demande->getFeaturedImage());
        }

        # Mise à jour du contenu
        $Demande->update(
            $DemandeRequest->getTitle(),
            $this->slugify($DemandeRequest->getTitle()),
            $DemandeRequest->getContent(),
            $DemandeRequest->getFeaturedImage(),
            $DemandeRequest->getSpecial(),
            $DemandeRequest->getSpotlight(),
            $DemandeRequest->getCreatedDate(),
            $DemandeRequest->getDays(),
            $DemandeRequest->getObservation(),
            $DemandeRequest->getIfEvenementFamilial(),
            $DemandeRequest->getJoursEvenementFamilial(),
            $DemandeRequest->getNatureEvenementFamilial(),
            $DemandeRequest->getDateEvenementFamilial(),
            $DemandeRequest->getIfCongePaye(),
            $DemandeRequest->getJoursCongePaye(),
            $DemandeRequest->getIfRtt(),
            $DemandeRequest->getMoisAcquisitionRtt(),
            $DemandeRequest->getIfCongeSansSolde(),
            $DemandeRequest->getJoursCongeSansSolde(),
            $DemandeRequest->getIfAutre(),
            $DemandeRequest->getJoursAutre(),

            $DemandeRequest->getJanvier(),
            $DemandeRequest->getFevrier(),
            $DemandeRequest->getMars(),
            $DemandeRequest->getAvril(),
            $DemandeRequest->getMai(),
            $DemandeRequest->getJuin(),
            $DemandeRequest->getJuillet(),
            $DemandeRequest->getAout(),
            $DemandeRequest->getSeptembre(),
            $DemandeRequest->getOctobre(),
            $DemandeRequest->getNovembre(),
            $DemandeRequest->getDecembre()
        );

        # Sauvegarde en BDD
        $this->em->flush();

        # On retourne notre Demande
        return $Demande;
    }

}